<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'discount_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'discount_code',
        'discount_type',
        'discount_value',
        'discount_min_purchase',
        'discount_max_uses',
        'discount_user_limit',
        'discount_start',
        'discount_end',
    ];

    protected $casts = [
        'discount_value' => 'decimal:0',
        'discount_min_purchase' => 'decimal:0',
        'discount_max_uses' => 'integer',
        'discount_user_limit' => 'integer',
        'discount_start' => 'date',
        'discount_end' => 'date',
    ];

    public function discountUses()
    {
        return $this->hasMany(DiscountUse::class, 'discount_id', 'discount_id');
    }
}
