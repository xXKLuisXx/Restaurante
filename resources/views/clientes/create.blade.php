@extends('layouts.admin')
@section ('contenido')
@if(Auth::user()->id_cliente == -1 and Auth::user()->roll == 1)
    <h3>Completa Tus Datos Para Continuar</h3>
@else
    <h3>Agregar Cliente</h3>
@endif
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
        
        {!!Form::open(array('url'=>'clientes','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre">
                <label for="nombre">Nombre</label>
            </div>
            
            <div class="input-field col s12">
                <input id="apellido" type="text" class="validate" name="apellido">
                <label for="apellido">Apellido</label>
            </div>
        
            @if(Auth::user()->id_cliente == -1 and Auth::user()->roll != 1)
            <div class="input-field col s12">
                <input id="usuario" type="text" class="validate" name="usuario" autocomplete="off">
                <label for="usuario">Usuario</label>
            </div>
            @endif
        
            @if(Auth::user()->id_cliente == -1 and Auth::user()->roll != 1)
                <div class="input-field col s12">
                    <input id="contrasena" type="password" class="validate" name="contrasena" autocomplete="off">
                    <label for="contrasena">Contraseña</label>
                </div>
            @endif
        
            <div class="input-field col s12">
                <input id="RFC" type="text" class="validate" name="RFC" data-length="13">
                <label for="RFC">RFC</label>
            </div>
        
            @if(Auth::user()->id_cliente == -1 and Auth::user()->roll != 1)
            <div class="input-field col s12">
                <input id="correo" type="email" class="validate" name="correo">
                <label for="correo">Correo Electronico</label>
            </div>
            @else
                <input id="correo" type="hidden" class="validate" name="correo" value ="{{Auth::user()->email}}a">
            @endif
        
            <div class="input-field col s12">
                <input id="domicilio" type="text" class="validate" name="domicilio">
                <label for="domicilio">Domicilio</label>
            </div>
        
            <div class="input-field col s12">
                <input id="telefono" type="tel" class="validate" name="telefono">
                <label for="telefono">Telefono</label>
            </div>
        
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
