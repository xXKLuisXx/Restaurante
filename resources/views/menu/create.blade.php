@extends('layouts.admin')
@section ('contenido')
    <h3>Agregar Producto</h3>
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
        
        {!!Form::open(array('url'=>'menu','method'=>'POST','autocomplete'=>'off','files'=>true))!!}
        {{Form::token()}}
            <div class="input-field col s12">
                <input id="nombre" type="text" class="validate" name="nombre">
                <label for="nombre">Nombre</label>
            </div>
            
            <div class="input-field col s12">
                <textarea id="descripcion" class="materialize-textarea" name="descripcion"></textarea>
                  <label for="descripcion">Descripción</label>
            </div>
        
            <div class="input-field col s6">
                <select name="id_categoria">
                  @foreach($categorias as $cat)
                        <option value="{{$cat->id_categoria}}">{{$cat->nombre}}</option>
                    @endforeach
                </select>
                <label>Categoria</label>
              </div>  
            <div class="input-field col s6">
                <input id="precio" type="number" class="validate" name="precio">
                <label for="precio">Precio</label>
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
