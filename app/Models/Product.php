<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'school_id',
        'product_name',
        'product_description',
        'product_image',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'product_id', 'product_id');
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    public function waitlists()
    {
        return $this->hasMany(Waitlist::class, 'product_id', 'product_id');
    }
}
