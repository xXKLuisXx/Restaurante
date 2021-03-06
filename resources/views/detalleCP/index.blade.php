@extends('layouts.admin')
@section ('contenido')
    <h3>Pedido</h3>
    <div class="col l12 m12 s12 lx12">
        <h3 style="margin-top: 43px;">Detalle Pedido</h3>
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
                                <a href="{{URL::action('DetalleVentaPublicoController@edit',$es->id_detalleventa)}}"><button class="btn btn-facebook">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$es->id_detalleventa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                        @include('detalleCP.modal')
                        @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
        @endif
        <div>
            <h4>Productos Disponibles</h4>
            <style>
                .carousel{
                    width: 500px;
                    height: 400px;
                }
            </style>
             <div class="carousel carousel-slider center" style="    margin: 0 auto;">
                 @foreach($disponibles as $dis)
                    <div class="carousel-item white-text" href="#{{$dis->id_producto}}">
                        @if(!is_null($dis->foto))                    
                            <img src="http://localhost/proyecto2/public/img/productos/{{$dis->foto}}" style="width: auto; height: 100%;">
                        @else    
                            <img src="http://localhost/proyecto2/public/img/default.jpg" style="width: auto; height: 100%;">
                        @endif
                      <div style="position: absolute; top: 230px; right: 50%; margin-right: -200px; width: 400px;">
                          <p class="white-text"><a href="" data-target="#modal-verDispo-{{$dis->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Ver Detalle</button></a></p>
                          <h2 style="margin-top: 10px;">{{$dis->nombre}}</h2>
                      </div>
                    </div>
                 @endforeach
              </div>
        </div>
        @foreach($disponibles as $dis)
                <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-verDispo-{{$dis->id_producto}}">
    
                    <div class="modal-dialog"  style="width: auto; margin: auto auto; height: 100%; ">
                        <div class="modal-content" style="height: 100%;">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title">{{$dis->nombre}}</h4>   
                            </div>
                            <div class="modal-body" style="overflow:auto;">
                                <div class="col m6 l6 s6" style="height: 256px; overflow-y: auto;">
                                    <p><strong style="font-weight: 700;">Categoria: </strong>{{$dis->categoria}}</p>
                                    <table >
                                        <thead>
                                            <th style="font-weight: 700;">Tamaño</th>
                                            <th style="font-weight: 700;">Precio</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Chico</td>
                                                <td>{{1*$dis->precio}}</td>
                                            </tr>
                                            <tr>
                                                <td>Mediano</td>
                                                <td>{{2*$dis->precio}}</td>
                                            </tr>
                                            <tr>
                                                <td>Grande</td>
                                                <td>{{3*$dis->precio}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><strong style="font-weight: 700;">Descripcion: </strong><br>{{$dis->descripcion}}</p>
                                </div>
                                <div class="col m6 l6 s6">
                                    @if(!is_null($dis->foto))                    
                                        <img src="http://localhost/proyecto2/public/img/productos/{{$dis->foto}}" style="max-width:100%;">
                                    @else    
                                        <img src="http://localhost/proyecto2/public/img/default.jpg" style="max-width:80%;">
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        {!!Form::open(array('url'=>'detalleCP','method'=>'POST','autocomplete'=>'off'))!!}
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
                <a href="{{route('ventasP.index')}}" class="btn btn-primary">Terminar</a>
            </div>
        {!!Form::close()!!}
    </div>

@stop
