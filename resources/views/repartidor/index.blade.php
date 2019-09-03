@extends('layouts.admin')
@section ('contenido')
    <style>
        .panel{
            border: 1px solid #cea737;
            border-radius: 7px;
            min-height: 350px;
        }
        strong{
            font-weight: bold;
        }
    </style>
    <div class="row">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                @foreach($ventas as $es)
                    @if($es->status == 3 || $es->status == 4 )
                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                            <div class="col-xs-12">
                                <h5>Detalles del Pedido #{{$es->id_venta}}</h5>
                            </div>
                            <p>
                                <strong>Nombre Cliente: </strong> <br>
                                {{$es->nombreP}}
                            </p>
                            <p>
                                <strong>Teléfono: </strong> <br>
                                {{$es->telefonoP}}
                            </p>
                            <p>
                                <strong>Domicilio: </strong> <br>
                                {{$es->domicilioP}}
                            </p>
                            <a style="bottom: 13px; position: absolute; left: 50%; margin-left: -150px;" href="{{URL::action('RepartidorController@edit',$es->id_venta)}}"><button class="btn btn-github" 
                            @if($es->status == 4)
                                    disabled
                            @endif >Repartir</button></a>
                            <a style="bottom: 13px; position: absolute; left: 50%; margin-left: 5px;" href="{{URL::action('RepartidorController@show',$es->id_venta)}}"><button class="btn btn-github">Entregado</button></a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            {{$ventas->render()}}
        </div>
    </div>
@endsection