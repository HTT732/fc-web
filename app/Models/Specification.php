<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

     /**
     * Get all product of specification
     *
     * @return  string
     */
    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id');
    }
}
