<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    protected $table = 'tarjetas';
      // Deshabilitar el manejo automático de los timestamps
      public $timestamps = false;
      
    protected $fillable = [
        'nombre',
        'imagen',
    ];
}
