<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'school_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'school_name',
        'school_nit',
        'school_address',
        'school_image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'school_id', 'school_id');
    }
}
