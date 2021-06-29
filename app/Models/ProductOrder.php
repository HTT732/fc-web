<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    public $fillable = [
        'product_id',
        'order_id',
        'order_number',
        'order_token'
    ];

     /**
     * Get all pictures of product
     *
     * @return  string
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function scopeWhereProductId($query, $value)
    {
        return $query->where('product_id', $value);
    }

    public function scopeWhereToken($query, $value)
    {
        return $query->where('order_token', $value);
    }

    public function scopeActive($query)
    {
        return $query->where('active', '>', 0);
    }
}
