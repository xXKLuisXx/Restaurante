@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Ventas</h3>
            <div class="col s3">
                <a href="ventas/create"><button class="btn btn-success">Nueva</button></a>
            </div>
            @include('ventas.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>status</th>
                            <th>Monto</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($ventas as $es)
                            <tr>
                                <td>{{$es->fecha}}</td>
                                <td>{{$es->cliente}}</td>
                                <td>
                                    @if($es->status == 1)
                                        En cocina
                                    @elseif($es->status == 2)
                                        En cocina
                                    @elseif($es->status == 3)
                                        Listo Para Entrega
                                    @elseif($es->status == 4)
                                        En camino
                                    @elseif($es->status == 5)
                                        Entregado
                                    @elseif($es->status == 0)
                                        Cotización
                                    @endif
                                </td>
                                <td>${{$es->monto}}</td>
                                <td>
                                    <a href="" data-target="#modal-ver-{{$es->id_venta}}" data-toggle="modal"><button class="btn btn-reddit">Ver</button></a>
                                    <a href="{{URL::action('VentaController@edit',$es->id_venta)}}"><button class="btn btn-primary">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$es->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    <a href="{{URL::action('VentaController@show',$es->id_venta)}}" data-toggle="modal"><button class="btn btn-reddit">Imprimir Reporte</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$ventas->render()}}
            </div>
            @foreach($ventas as $es)
                @include('ventas.modal')
            @endforeach
        </div>
    </div>
@endsection