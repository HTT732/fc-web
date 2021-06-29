<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'quanlity',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'customer_note',
        'payment'
    ];

    /**
     * Get all order of product
     *
     * @return  string
     */
//    public function productOrder()
//    {
//        return $this->hasMany('\App\Models\ProductOrder', 'order_id');
//    }

    public function product()
    {
        return $this->belongstoMany('\App\Models\Product', 'product_orders')->withPivot(['order_token']);
    }
}
