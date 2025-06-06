<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waitlist extends Model
{
    /** @use HasFactory<\Database\Factories\WaitlistFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'waitlist_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'waitlist_notified',
    ];

    protected $casts = [
        'waitlist_notified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
}
