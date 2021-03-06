<?php

if (!function_exists('route_class')) {
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

if (!function_exists('ngrok_url')) {
    function ngrok_url($routeName, $parameters = [])
    {
        if (app()->environment('local') && $url = config('app.ngrok_url')) {
            return $url.route($routeName, $parameters, false);
        }

        return route($routeName, $parameters);
    }
}

if (!function_exists('big_number')) {
    function big_number($number, $scale = 2)
    {
        return new \Moontoast\Math\BigNumber($number, $scale);
    }
}
