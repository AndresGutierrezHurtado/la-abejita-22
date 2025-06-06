<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'order_item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'item_quantity',
        'item_price',
    ];

    protected $casts = [
        'item_quantity' => 'integer',
        'item_price' => 'decimal:0',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
}
