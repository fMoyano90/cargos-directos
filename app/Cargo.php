<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = [
        'lote', 
        'fecha_entrada', 
        'detalle',
        'nro_contable', 
        'ubicacion', 
        'cantidad_stock', 
        'salida',
        'cantidad_salida', 
        'fecha_salida', 
        'correo', 
        'observacion', 
        'stock_actual',
        'vencimiento', 
        'created_at'
    ];
}
