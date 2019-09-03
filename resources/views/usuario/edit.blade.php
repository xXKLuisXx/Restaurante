@extends('layouts.admin')
@section ('contenido')
    <h3>Editar Usuario : {{$usuario->name}}</h3>
    <div class="col l12 m12 s12 lx12">
        @if((count($errors)>0))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        {!!Form::model($usuario,['method'=>'PATCH','route'=>['usuario.update',$usuario->id]])!!}
        {{Form::token()}}
            <div class="form-group row">
                            <div class="input-field col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="color: #ff260b;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-field col-md-6">
                                
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color: #ff260b;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                 <label for="email" class="col-md-4 col-form-label text-md-right">Correo Eléctronico</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-field col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="color: #ff260b;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                 <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="input-field col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                 <label for="password-confirm" class="col-md-12 col-form-label text-md-right">Confirmar Contraseña</label>
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <select name="roll">
                                @if($usuario->roll==0)
                                    <option value="0" selected>Administrador</option>
                                @else
                                    <option value="0">Administrador</option>
                                @endif
                                @if($usuario->roll==2)
                                <option value="2" selected>Chef</option>
                                @else
                                    <option value="2">Chef</option>
                                @endif
                                @if($usuario->roll==3)
                                    <option value="3" selected>Repartidor</option>
                                @else
                                    <option value="3">Repartidor</option>
                                @endif
                            </select>
                            <label>Roll</label>
                        </div>
            <div class="input-field col s12">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>
@stop
