<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_first_name',
        'user_last_name',
        'user_username',
        'user_email',
        'user_password',
        'role_id',
    ];

    protected $hidden = [
        'user_password',
        'role_id',
        'remember_token',
    ];

    // Mutator para el campo de la contraseña
    public function setPasswordAttribute($value)
    {
        $this->attributes['user_password'] = Hash::make($value);
    }

    // Obtener el campo de contraseña para la autenticación
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
