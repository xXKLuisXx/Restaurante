@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Usuarios Del Sistema</h3>
            <div class="col s3">
                <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('usuario.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Correo Eléctronico</th>
                            <th>Roll</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $au)
                            <tr>
                                <td>{{$au->name}}</td>
                                <td>{{$au->email}}</td>
                                <td>
                                @if($au->roll==0)
                                    Administrador
                                @elseif($au->roll==2)
                                    Chef
                                @elseif($au->roll==3)
                                    Repartidor
                                @else
                                    Cliente
                                @endif
                                </td>
                                <td>
                                    @if($au->roll!=1)
                                        <a href="{{URL::action('UsuarioController@edit',$au->id)}}"><button class="btn btn-reddit">Editar</button></a>
                                    @else
                                        <a href="{{URL::action('ClienteController@edit',$au->id_cliente)}}"><button class="btn btn-reddit">Editar</button></a>
                                    @endif
                                    @if($au->roll!=1)
                                        <a href="" data-target="#modal-delete-{{$au->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    @else
                                        <a href="" data-target="#modal-delete-{{$au->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    @endif
                                </td>
                            </tr>
                            @include('usuario.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$usuarios->render()}}
            </div>
        </div>
    </div>
@endsection