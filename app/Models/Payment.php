<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'payment_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'payment_status',
        'payment_amount',
        'payment_date',
    ];

    protected $casts = [
        'payment_amount' => 'decimal:0',
        'payment_date' => 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id', 'payment_id');
    }
}
