@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Clientes</h3>
            <div class="col s3">
                <a href="clientes/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('clientes.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($clientes as $au)
                            <tr>
                                <td>{{$au->nombre}} {{$au->apellido}}</td>
                                <td>{{$au->e_mail}}</td>
                                <td>
                                    <a href="{{URL::action('ClienteController@edit',$au->id_cliente)}}"><button class="btn btn-reddit">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$au->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                            @include('clientes.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$clientes->render()}}
            </div>
        </div>
    </div>
@endsection