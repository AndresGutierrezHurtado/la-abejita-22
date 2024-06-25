<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paymentDetails()
    {
        return $this->hasOne(PaymentDetail::class, 'order_id');
    }

    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class, 'order_id');
    }
}
