@extends('layouts.admin')
@section ('contenido')
    <h3>Agregar Libro</h3>
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
        
        {!!Form::open(array('url'=>'estante','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="titulo" type="text" class="validate" name="titulo">
                <label for="titulo">Titulo</label>
            </div>
            <div class="input-field col s6">
                <input id="edicion" type="text" class="validate" name="edicion">
                <label for="edicion">Edicion</label>
            </div>
            <div class="input-field col s6">
                <input id="precio" type="text" class="validate" name="precio">
                <label for="precio">Precio</label>
            </div>
         <div class="input-field col s6">
                <select name="id_autor">
                  @foreach($autores as $au)
                        <option value="{{$au->id_autor}}">{{$au->nombre}}</option>
                    @endforeach
                </select>
                <label>Autor</label>
              </div>
            <div class="input-field col s6">
                <input id="existencia" type="number" class="validate" name="existencia">
                <label for="existencia">Existencia</label>
            </div>
            <div class="input-field col s12">
                <textarea id="descripcion" class="materialize-textarea" name="descripcion"></textarea>
                  <label for="descripcion">Descripción</label>
            </div>
            <div class="input-field col s6">
                <select name="id_genero">
                  @foreach($generos as $ge)
                        <option value="{{$ge->id_genero}}">{{$ge->nombre}}</option>
                    @endforeach
                </select>
                <label>Genero</label>
            </div>
            <div class="input-field col s6">
                <select name="id_editorial">
                  @foreach($editoriales as $ed)
                        <option value="{{$ed->id_editorial}}">{{$ed->nombre}}</option>
                    @endforeach
                </select>
                <label>Editorial</label>
            </div>
            <div class=" col s6 file-field input-field">
              <div class="btn">
                <span>File</span>
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
