<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'slug', 'active'];
     /**
     * Get all categoris of product
     *
     * @return  string
     */
    public function product()
    {
        return $this->hasMany('\App\Models\Product', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
