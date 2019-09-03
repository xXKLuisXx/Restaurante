@extends('layouts.admin')
@section ('contenido')
    <style>
        .panel{
            border: 1px solid #cea737;
            border-radius: 7px;
            min-height: 350px;
        }
    </style>
    <div class="row">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                @foreach($ventas as $es)
                    @if($es->status == 1 || $es->status == 2)
                    <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel">
                            <div class="col-xs-12">
                                <h5>Detalles del Pedido #{{$es->id_venta}}</h5>
                            </div>
                            @include('chef.modal')
                            <a style="bottom: 13px; position: absolute; left: 50%; margin-left: -71px;" href="{{URL::action('ChefController@edit',$es->id_venta)}}"><button class="btn btn-danger">Terminado</button></a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            {{$ventas->render()}}
        </div>
    </div>
@endsection