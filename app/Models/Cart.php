<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'cart_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_size_id',
        'cart_quantity',
    ];

    protected $casts = [
        'cart_quantity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id', 'product_id');
    }
}
