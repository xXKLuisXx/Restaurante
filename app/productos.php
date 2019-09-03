<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table='producto';
    protected $primaryKey = 'id_producto';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'id_categoria',
        'descripcion',
        'foto',
        'activo',
        'precio'
    ];
}
