<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class editorial extends Model
{
    protected $table='editorial';
    protected $primaryKey = 'id_editorial';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'encargado',
        'e-mail'.
        'rfc'
    ];
}
