@extends('layouts.admin')
@section ('contenido')
    <h3>Nueva Compra</h3>
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
        
        {!!Form::open(array('url'=>'compras','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
            <div class="input-field col s6">
                <input name="status" type="hidden" value="1">
                <input id="fecha" type="text" class="datepicker" name="fecha">
                <label for="fecha">fecha</label>
            </div>
            <div class="input-field col s6">
                <select name="id_provedor">
                  @foreach($proveedores as $pro)
                        <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                    @endforeach
                </select>
                <label>Cliente</label>
            </div>
           
            <div class="input-field col s12">
                <button type="submit" class="btn btn-primary">Continuar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
