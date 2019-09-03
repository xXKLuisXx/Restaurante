@extends('layouts.admin')
@section ('contenido')
    <h3>Agregar Categoria</h3>
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
        
        {!!Form::open(array('url'=>'categorias','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class=" col s12 file-field input-field">
              <div class="btn">
                <span>Imagen</span>
                <input type="file" name="imagen">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
