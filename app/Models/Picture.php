<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'small',
        'medium',
        'large',
        'product_id'
    ];
    
     /**
     * Get all pictures of product
     *
     * @return  string
     */
    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id');
    }
}
