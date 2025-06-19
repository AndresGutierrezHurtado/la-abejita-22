<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'user_name',
        'user_lastname',
        'user_email',
        'user_phone',
        'user_address',
        'user_image',
        'user_password',
        'role_id',
    ];

    protected $hidden = [
        'user_password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function discountUses()
    {
        return $this->hasMany(DiscountUse::class, 'user_id', 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id', 'user_id');
    }

    public function waitlists()
    {
        return $this->hasMany(Waitlist::class, 'user_id', 'user_id');
    }

    public function setUserPasswordAttribute($value)
    {
        $this->attributes['user_password'] = Hash::make($value);
    }
}
