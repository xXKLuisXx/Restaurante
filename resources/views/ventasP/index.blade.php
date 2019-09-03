@extends('layouts.admin2')
@section ('contenido')
    @if(Auth::user()->id_cliente == -1 and Auth::user()->roll == 1)
        <script>
            window.location.replace("clientes/create");
        </script>
    @endif
    <script>
        function actualiza() {
            setTimeout(function(){ location.reload(); }, 3000);
        }
    </script>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Pedidos</h3>
            <div class="col s3">
                <a href="ventasP/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('ventasP.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Fecha</th>
                            <th>Status</th>
                            <th>Sub-Total</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($ventas as $es)
                            <tr>
                                <td>{{$es->fecha}}</td>
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
                                    Entregado / Pagado
                                @elseif($es->status == 0)
                                    Cotización
                                @endif
                                </td>
                                <td>${{$es->monto}}</td>
                                <td>
                                    <a href="" data-target="#modal-ver-{{$es->id_venta}}" data-toggle="modal"><button class="btn btn-reddit">Ver</button></a>
                                    @if($es->status == 0)
                                        <a href="{{URL::action('VentaPublicoController@edit',$es->id_venta)}}"><button class="btn btn-primary">Editar</button></a>
                                    @else
                                        <a><button class="btn btn-primary" disabled>Editar</button></a>
                                    @endif
                                    <a href="" data-target="#modal-delete-{{$es->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    <a href="{{URL::action('VentaPublicoController@show',$es->id_venta)}}" data-toggle="modal" onclick="actualiza()"><button class="btn btn-reddit">
                                        @if($es->status == 0)
                                            Efectuar Pedido
                                        @else
                                            Imprimir Reporte
                                        @endif
                                    </button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$ventas->render()}}
            </div>
            @foreach($ventas as $es)
                @include('ventasP.modal')
            @endforeach
        </div>
    </div>
@endsection