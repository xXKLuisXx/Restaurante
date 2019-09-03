<?php

namespace libreria;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $table='cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'usuario',
        'contrasena',
        'apellido',
        'rfc',
        'domicilio',
        'telefono',
        'e_mail'
    ];
}
