@extends('layouts.admin')
@section ('contenido')
    <h3>Editar </h3>
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
    {!!Form::model($venta,['method'=>'PATCH','route'=>['detalleCP.update',$venta->id_detalleventa]])!!}
    {{Form::token()}}
          
            <div>
                 <div class="input-field col s6">
                    <input name="id_venta" type="hidden" value="{{$venta->id_venta}}">
                    <select name="id_producto">
                      @foreach($disponibles as $dis)
                        @if($dis->id_producto == $venta->id_producto)
                            <option value="{{$dis->id_producto}}" selected >{{$dis->nombre}}</option>
                        @else
                            <option value="{{$dis->id_producto}}">{{$dis->nombre}}</option>
                        @endif
                      @endforeach
                    </select>
                    <label>Producto</label>
                </div>
                <div class="input-field col s3">
                    <input id="cantidad" type="number" name="cantidad" value="{{$venta->cantidad}}">
                    <label for="cantidad">Cantidad</label>
                </div>
                <div class="input-field col s3" style="display:none;">
                    <input id="precio_unitario" type="number" name="precio_unitario" value="{{$venta->precio_unitario}}">
                    <label for="precio_unitario">Precio Unitario</label>
                </div>
                <div class="input-field col s3">
                <select name="id_tamano">
                    @if($venta->id_tamano == 1)
                    <option value="1" selected >Chico</option>
                    @else
                    <option value="1">Chico</option>
                    @endif
                    
                    @if($venta->id_tamano == 2)
                    <option value="2" selected>Mediano</option>
                    @else
                    <option value="2">Mediano</option>
                    @endif
                    
                    @if($venta->id_tamano == 3)
                    <option value="3" selected>Grande</option>
                    @else
                    <option value="3">Grande</option>
                    @endif
                </select>
                <label>Tamaño</label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>    
    {{Form::Close()}}
    </div>
@stop

