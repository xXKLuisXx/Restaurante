@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Productos</h3>
            <div class="col s3">
                <a href="menu/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('menu.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($productos as $pro)
                            <tr>
                                <td>{{$pro->nombre}}</td>
                                <td>{{$pro->categoria}}</td>
                                <td>
                                    <a href="" data-target="#modal-ver-{{$pro->id_producto}}" data-toggle="modal"><button class="btn btn-reddit">Ver</button></a>
                                    <a href="{{URL::action('ProductoController@edit',$pro->id_producto)}}"><button class="btn btn-bitbucket">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$pro->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                            @include('menu.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$productos->render()}}
            </div>
        </div>
    </div>
@endsection