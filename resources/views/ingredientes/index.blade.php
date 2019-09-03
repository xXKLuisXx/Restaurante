@extends('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Editoriales</h3>
            <div class="col s3">
                <a href="editorial/create"><button class="btn btn-success">Nuevo</button></a>
            </div>
            @include('editorial.search')
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Encargado</th>
                            <th>Correo Electronico</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($editorial as $ed)
                            <tr>
                                <td>{{$ed->nombre}}</td>
                                <td>{{$ed->encargado}}</td>
                                <td>{{$ed->e_mail}}</td>
                                <td>
                                    <a href="{{URL::action('EditorialController@edit',$ed->id_editorial)}}"><button class="btn btn-info">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$ed->id_editorial}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            </tr>
                            @include('editorial.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$editorial->render()}}
            </div>
        </div>
    </div>
@endsection