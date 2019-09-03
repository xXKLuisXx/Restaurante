@extends('layouts.admin')
@section ('contenido')
    <h3>Editar Cliente : {{$cliente->nombre}} {{$cliente->apellido}}</h3>
    <div class="col l12 m12 s12 lx12">
        @if((count($errors)>0))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        {!!Form::model($cliente,['method'=>'PATCH','route'=>['clientes.update',$cliente->id_cliente]])!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre" value="{{$cliente->nombre}}">
                <label for="nombre">Nombre</label>
            </div>
        
            <div class="input-field col s12">
                <input id="apellido" type="text" class="validate" name="apellido" value="{{$cliente->apellido}}">
                <label for="apellido">Apellido</label>
            </div>
        
            <div class="input-field col s12">
                <input id="usuario" type="text" class="validate" name="usuario" value="{{$cliente->usuario}}">
                <label for="usuario">Usuario</label>
            </div>
        
            <div class="input-field col s12">
                <input id="contrasena" type="password" class="validate" name="contrasena" value="{{$cliente->contrasena}}">
                <label for="contrasena">Contraseña</label>
            </div>
            
            <div class="input-field col s12">
                <input id="RFC" type="text" class="validate" name="RFC" data-length="13" value="{{$cliente->rfc}}">
                <label for="RFC">RFC</label>
            </div>
        
            <div class="input-field col s12">
                <input id="correo" type="email" class="validate" name="correo" value="{{$cliente->e_mail}}">
                <label for="correo">Correo Electronico</label>
            </div>
        
            <div class="input-field col s12">
                <input id="domicilio" type="text" class="validate" name="domicilio" value="{{$cliente->domicilio}}">
                <label for="domicilio">Domicilio</label>
            </div>
        
            <div class="input-field col s12">
                <input id="telefono" type="tel" class="validate" name="telefono" value="{{$cliente->telefono}}">
                <label for="telefono">Telefono</label>
            </div>
        
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
