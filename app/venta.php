<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    protected $table='ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps=false;
    
    protected $fillable = [
        'id_cliente',
        'status',
        'fecha'
    ];
}
