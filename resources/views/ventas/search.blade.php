{!! Form::open(array('url'=>'ventas','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="input-field col s6">
    <input value="{{$busqueda}}" id="busqueda" type="text" class="validate" name="busqueda">
    <label for="busqueda">Busqueda</label>
</div>
<div class="col s3">
    <button type="submit" class="btn btn-primary">Buscar</button>
</div>

{{Form::close()}}