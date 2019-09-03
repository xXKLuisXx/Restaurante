<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class genero extends Model
{
    protected $table='genero';
    protected $primaryKey = 'id_genero';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre'
    ];
}

