<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
use HasFactory;
 public $timestamps = false; //para que no me de error con los timestamps

protected $table = 'pets';
protected $fillable = ['name', 'image', 'description'];


    //Relacion con User 
 public function user()
    {
        return $this->belongsTo(User::class);
    }

}
