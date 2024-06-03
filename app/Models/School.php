<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $primaryKey = 'school_id';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'school_products', 'school_id', 'product_id');
    }
}
