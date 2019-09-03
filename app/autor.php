<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class autor extends Model
{
    protected $table='autor';
    protected $primaryKey = 'id_autor';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'biografia'  
    ];
}
