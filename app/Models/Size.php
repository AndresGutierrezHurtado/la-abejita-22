<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /** @use HasFactory<\Database\Factories\SizeFactory> */
    use HasFactory;

    protected $primaryKey = 'size_id';

    public $timestamps = false;

    protected $fillable = [
        'size_name',
    ];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'size_id', 'size_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'size_id', 'size_id');
    }

    public function waitlists()
    {
        return $this->hasMany(Waitlist::class, 'size_id', 'size_id');
    }
}
