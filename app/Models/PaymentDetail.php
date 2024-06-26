<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payments_details';

    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'payment_state',
        'payment_method',
        'payment_amount',
        'payment_buyer_email',
        'payment_buyer_full_name',
        'payment_buyer_phone',
        'payment_buyer_document_type',
        'payment_buyer_document_number',
        'payment_delivery_option',
        'payment_shipping_address',
        'payment_description',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
