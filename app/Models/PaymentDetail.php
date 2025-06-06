<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentDetailFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'payment_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'payment_id',
        'payment_method',
        'payment_detail_status',
        'payment_buyer_name',
        'payment_buyer_email',
        'payment_buyer_document',
        'payment_buyer_document_type',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }
}
