<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 收货地址模型
 *
 * Class UserAddress
 * @package App\Models
 */
class UserAddress extends Model
{
    /**
     * 批量填充字段
     *
     * @var array
     */
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];

    /**
     * 时间日期类型
     *
     * @var array
     */
    protected $dates = ['last_used_at'];

    /**
     * 追加字段
     * @var array
     */
    protected $appends = ['full_address'];

    /**
     * 逆向关联用户表一对多
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 转换地址
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }

}
