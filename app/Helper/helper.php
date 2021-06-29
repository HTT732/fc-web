<?php


if (!function_exists('format_price')) {
    function format_price ($price)
    {
        return number_format((int)$price);
    }
}

if (!function_exists('makeCookie')) {
    function makeCookie($name, $value = '', $domain = '') {
        $domain = empty($domain) ? env('APP_URL') : $domain;
        if (empty($value)) {
            $value = Str::random(64);
        }
        // set cookie 
        if(!Cookie::get($name)) {
           setCookie($name, $value, time()+3600*24*30, '/', $domain);
        }
    }
}

if (!function_exists('order_code')) {
    function order_code($number) {
        if ($number < 10)
            return '#ĐH0'.$number;
        return '#ĐH'.$number;
    }
}

if (!function_exists('format_date')) {
    function format_date($date) {
        return date_format($date, 'H:i d-m-Y');
    }
}

if (!function_exists('total_price')) {
    function total_price($qty, $price) {
        if (empty($qty) || empty($price))
            return 0;

        if (is_numeric($qty) && is_numeric($price)) {
            return format_price($qty * $price);
        }
       
        if (is_array($qty) && is_array($price)) {
            $len = 0;
            $total = 0;

            if (count($qty) == count($price)) {
                $len = count($qty);
            } else {
                dd('a');
                return $total;
            }
            
            for ($i = 0; $i <= $len; $i++) {
                $total += $qty[$i]['quanlity'] * $price[$i]['price'];
            }

            return format_price($total);
        }
    }
}
?>