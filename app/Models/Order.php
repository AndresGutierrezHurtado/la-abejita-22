<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'order_status',
        'payment_reference',
    ];

    protected $casts = [
        'order_status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id', 'order_id');
    }

    public function discountUses()
    {
        return $this->hasMany(DiscountUse::class, 'order_id', 'order_id');
    }
}
