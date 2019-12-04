<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    protected $fillable = [
        'correo',
        'primero',
        'segundo', 
        'tercero' 
    ];
}
