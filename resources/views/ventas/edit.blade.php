@extends('layouts.admin')
@section ('contenido')
    <h3>Editar Venta</h3>
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
        
        {!!Form::model($venta,['method'=>'PATCH','route'=>['ventas.update',$venta->id_venta]])!!}
        {{Form::token()}}
            <div class="input-field col s6">
                <input name="status" type="hidden" value="1">
                <input id="fecha" type="text" class="datepicker" name="fecha" value="{{$venta->fecha}}">
                <label for="fecha">fecha</label>
            </div>
            <div class="input-field col s6">
                <select name="id_cliente">
                  @foreach($clientes as $au)
                        @if($au->id_cliente == $venta->id_cliente)
                            <option value="{{$au->id_cliente}}" selected >{{$au->nombre}}</option>
                        @else
                            <option value="{{$au->id_cliente}}">{{$au->nombre}}</option>
                        @endif
                    @endforeach
                </select>
                <label>Cliente</label>
              </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        {!!Form::close()!!}
    </div>
    
    <div class="col l12 m12 s12 lx12">
        <h3 style="margin-top: 46px;">Detalle de Venta</h3>
        @if((count($errors)>0))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if((count($productos)>0))
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Producto</th>
                        <th>Tamaño</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($productos as $es)
                        <tr>
                            <td>{{$es->nombre}}</td>
                            <td>
                                    @if($es->id_tamano == 1)
                                        Chico
                                    @elseif($es->id_tamano == 2)
                                        Mediano
                                    @elseif($es->id_tamano == 3)
                                        Grande
                                    @endif
                            </td>
                            <td>{{$es->cantidad}}</td>
                            <td>{{$es->precio_unitario}}</td>
                            <td>${{($es->cantidad)*($es->precio_unitario)}}</td>
                            <td>
                                <a href="{{URL::action('DetalleVentaController@edit',$es->id_detalleventa)}}"><button class="btn btn-facebook">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$es->id_detalleventa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                        @include('detalle.modal')
                        @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
        @endif
        {!!Form::open(array('url'=>'detalle','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
            <div class="input-field col s6">
                <input name="id_venta" type="hidden" value="{{$id_venta}}">
                <select name="id_producto">
                  @foreach($disponibles as $dis)
                    <option value="{{$dis->id_producto}}">{{$dis->nombre}}</option>
                  @endforeach
                </select>
                <label>Producto</label>
            </div>
            <div class="input-field col s3">
                <input id="cantidad" type="number" name="cantidad">
                <label for="cantidad">Cantidad</label>
            </div>
         <div class="input-field col s3">
                <select name="id_tamano">
                    <option value="1" selected >Chico</option>
                    <option value="2">Mediano</option>
                    <option value="3">Grande</option>
                </select>
                <label>Tamaño</label>
              </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-primary">Continuar</button>
                <a href="{{route('ventas.index')}}" class="btn btn-primary">Terminar</a>
            </div>
        {!!Form::close()!!}
    </div>
@stop
