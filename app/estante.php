<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class estante extends Model
{
    protected $table='libro';
    protected $primaryKey = 'id';
    public $timestamps=false;
    
    protected $fillable = [
        'titulo',
        'edicion',
        'precio',
        'id_autor',
        'existencia',
        'descripcion',
        'id_genero',
        'id_editorial',
        'fecha',
        'fecha_registros',
        'foto'
    ];
}
