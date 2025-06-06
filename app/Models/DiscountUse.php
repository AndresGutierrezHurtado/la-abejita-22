<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountUse extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountUseFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'discount_use_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'discount_id',
        'order_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'discount_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
