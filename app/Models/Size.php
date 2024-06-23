<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $primaryKey = 'size_id';

    // Relación con los productos que tienen esta talla
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_sizes', 'size_id', 'product_id')
                    ->withPivot(['product_size_price', 'product_size_stock']);
    }
}
