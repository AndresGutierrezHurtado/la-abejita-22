<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    /** @use HasFactory<\Database\Factories\ProductSizeFactory> */
    use HasFactory, HasUuids;

    protected $primaryKey = ['product_id', 'size_id'];
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'size_id',
        'size_stock',
        'size_price',
    ];

    protected $casts = [
        'size_stock' => 'integer',
        'size_price' => 'decimal:0',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_size_id', 'product_id');
    }
}
