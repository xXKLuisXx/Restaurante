@extends('layouts.admin')
@section ('contenido')
    <h3>Editar Libro : {{$estante->titulo}}</h3>
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
        
        {!!Form::model($estante,['method'=>'PATCH','route'=>['estante.update',$estante->id]])!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="titulo" type="text" class="validate" name="titulo" value="{{$estante->titulo}}">
                <label for="titulo">Titulo</label>
            </div>
            <div class="input-field col s6">
                <input id="edicion" type="text" class="validate" name="edicion" value="{{$estante->edicion}}">
                <label for="edicion">Edicion</label>
            </div>
            <div class="input-field col s6">
                <input id="precio" type="text" class="validate" name="precio" value="{{$estante->precio}}">
                <label for="precio">Precio</label>
            </div>
            <div class="input-field col s6">
                <select name="id_autor">
                  @foreach($autores as $au)
                        @if($au->id_autor == $estante->id_autor)
                            <option value="{{$au->id_autor}}" selected >{{$au->nombre}}</option>
                        @else
                            <option value="{{$au->id_autor}}">{{$au->nombre}}</option>
                        @endif
                    @endforeach
                </select>
                <label>Autor</label>
              </div>
            <div class="input-field col s6">
                <input id="existencia" type="text" class="validate" name="existencia" value="{{$estante->existencia}}">
                <label for="existencia">Existencia</label>
            </div>
            <div class="input-field col s12">
                <textarea id="descripcion" class="materialize-textarea" name="descripcion">{{$estante->descripcion}}</textarea>
                  <label for="descripcion">Descripción</label>
            </div>
            <div class="input-field col s6">
                <input id="id_genero" type="number" class="validate" name="id_genero" value="{{$estante->id_genero}}">
                <label for="id_genero">Genero</label>
            </div>
            <div class="input-field col s6">
                <input id="id_editorial" type="number" class="validate" name="id_editorial" value="{{$estante->id_editorial}}">
                <label for="id_editorial">Editorial</label>
            </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
