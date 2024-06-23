<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    use HasFactory;
    protected $table = 'product_media'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'media_id'; // Nombre de la clave primaria
    public $timestamps = false;
    
    protected $fillable = [
        'media_url',
        'media_type',
        
    ];
}
