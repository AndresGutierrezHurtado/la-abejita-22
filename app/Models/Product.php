<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    
    // Relación con las escuelas que tienen este producto
    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_products', 'product_id', 'school_id');
    }
    
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes', 'product_id', 'size_id')
                    ->withPivot('product_size_price', 'product_size_stock');
    }
    
    public function media()
    {
        return $this->hasMany(ProductMedia::class, 'product_id');
    }
}
