<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $table='categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'imagen'  
    ];
}
