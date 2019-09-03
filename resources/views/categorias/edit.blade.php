@extends('layouts.admin')
@section ('contenido')
    <h3>Editar Categoria : {{$categoria->nombre}}</h3>
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
        
        {!!Form::model($categoria,['method'=>'PATCH','route'=>['categorias.update',$categoria->id_categoria]])!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre" value="{{$categoria->nombre}}">
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
