<?php

namespace App\Http\Controllers;

use App\Events\OrderReviewed;
use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\ApplyRefundRequest;
use App\Http\Requests\CrowdFundingOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\Request;
use App\Http\Requests\SeckillOrderRequest;
use App\Http\Requests\SendReviewRequest;
use App\Models\CouponCode;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Models\Order;
use App\Services\OrderService;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user  = $request->user();
        $address= UserAddress::find($request->get('address_id'));
        $coupon = null;

        if ($code = $request->input('coupon_code')) {
            $coupon = CouponCode::where('code', $code)->first();

            if (!$coupon) {
                throw  new CouponCodeUnavailableException('优惠券不存在');
            }
        }

        return $orderService->store($user, $address, $request->get('remark'), $request->get('items'), $coupon);
    }

    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    /**
     * 确认收货
     * @param Order $order
     * @param Request $request
     */
    public function received(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('发货状态不正确');
        }

        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        return $order;
    }

    public function review(Order $order)
    {
        $this->authorize('own', $order);

        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付, 不可评价');
        }

        return view('orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    public function sendReview(Order $order, SendReviewRequest $request)
    {
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单已评价,不可重复提交');
        }

        $reviews = $request->input('reviews');

        \DB::transaction(function () use ($reviews, $order) {
           foreach ($reviews as $review) {
               $orderItem = $order->items()->find($review['id']);

               $orderItem->update([
                   'rating'      => $review['rating'],
                   'review'      => $review['review'],
                   'reviewed_at' => Carbon::now(),
               ]);
           }

           $order->update(['reviewed' => true]);

           event(new OrderReviewed($order));
        });

        return redirect()->back();
    }

    public function applyRefund(Order $order, ApplyRefundRequest $request)
    {
        $this->authorize('own', $order);

        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付, 不可退款');
        }

        if ($order->refund_status !== Order::REFUND_STATUS_PENDING) {
            throw new InvalidRequestException('该订单已经申请退款, 请勿重复申请');
        }

        if ($order->type === Order::TYPE_CROWDFUNDING) {
            throw new InvalidRequestException('众筹订单不支持退款');
        }

        $extra = $order->extra?: [];
        $extra['refund_reason'] = $request->get('reason');
        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra'         => $extra,
        ]);

        return $order;
    }

    public function crowdfunding(CrowdFundingOrderRequest $request, OrderService $orderService)
    {
        $user    = $request->user();

        $user->addresses()->createMany([]);
        $sku     = ProductSku::find($request->input('sku_id'));
        $address = UserAddress::find($request->input('address_id'));
        $amount  = $request->input('amount');

        return $orderService->crowdfunding($user, $address, $sku, $amount);
    }

    public function seckill(SeckillOrderRequest $request, OrderService $orderService)
    {
        $user = $request->user();
        $address = UserAddress::find($request->input('address_id'));
        $sku = ProductSku::find($request->input('sku_id'));

        return $orderService->seckill($user, $address, $sku);
    }

}
