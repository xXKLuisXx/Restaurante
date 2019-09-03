<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class detalleventa extends Model
{
    protected $table='detalle_venta';
    protected $primaryKey = 'id_detalleventa';
    public $timestamps=false;
    
    protected $fillable = [
        'id_detalleventa',
        'id_venta',
        'id_producto',
        'id_tamano',
        'comentarios',
        'cantidad',
        'precio_unitario'
    ];
}
