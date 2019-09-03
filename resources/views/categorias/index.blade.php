@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Categorias</h3>
            <div class="col s3">
                <a href="categorias/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('categorias.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($categorias as $ge)
                            <tr>
                                <td>{{$ge->nombre}}</td>
                                <td>
                                    <a href="{{URL::action('CategoriaController@edit',$ge->id_categoria)}}"><button class="btn btn-info">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$ge->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                            @include('categorias.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$categorias->render()}}
            </div>
        </div>
    </div>
@endsection