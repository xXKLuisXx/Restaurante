@extends('layouts.admin')
@section ('contenido')
    <h3>Agregar Editorial</h3>
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
        
        {!!Form::open(array('url'=>'editorial','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
                <input id="encargado" type="text" class="validate" name="encargado">
                <label for="encargado">Encargado</label>
            </div>
            <div class="input-field col s12">
                <input id="e_mail" type="email" class="validate" name="e_mail">
                <label for="e_mail">Correo Electronico</label>
            </div>
            <div class="input-field col s12">
                <input id="rfc" type="text" class="validate" name="rfc">
                <label for="rfc">RFC</label>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
