<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'thumb_url',
        'slug',
        'category_id',
        'price',
        'active'
    ];
    /**
     * Get all specification of product
     *
     * @return  string
     */
    public function specification()
    {
        return $this->hasOne('\App\Models\Specification', 'product_id');
    }

     /**
     * Get all pictures of product
     *
     * @return  string
     */
    public function picture()
    {
        return $this->hasMany('\App\Models\Picture', 'product_id');
    }

     /**
     * Get all categoris of product
     *
     * @return  string
     */
    public function category()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id');
    }

     /**
     * Get all order of product
     *
     * @return  string
     */
    public function order()
    {
        return $this->belongstoMany('\App\Models\Order', 'product_orders')->withPivot(['order_token']);
    }

    /**
     * Get all order
     *
     * @return  string
     */
//    public function productOrder()
//    {
//        return $this->hasMany('App\Models\ProductOrder', 'product_id');
//    }

    /**
     * Scope filter product by price
     *
     * @return  string
     */
    public function filterPriceMin($query, $min)
    {
        return $query->where('price', '>=', $min);
    }

    public function filterPriceMax($query, $max)
    {
        return $query->where('price', '<=', $max);
    }

    public function filterSort($query, $sort)
    {
        return $query->orderBy('price', $sort);
    }

    public function filterSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function filterSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }
}
