<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$pro->id_producto}}">
    {{Form::Open(array('action'=>array('ProductoController@destroy',$pro->id_producto),'method'=>'delete'))}}
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            <h4 class="modal-title">Eliminar Producto</h4>   
            </div>
            <div class="modal-body">
                 <p>Confirme si desea Eliminar El Producto</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-´rimary">Confirmar</button>
            </div>
        </div>
    </div>
    
    {{Form::Close()}}
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-ver-{{$pro->id_producto}}">
    
    <div class="modal-dialog"  style="width: auto; margin: auto auto; height: 100%; ">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            <h4 class="modal-title">{{$pro->nombre}}</h4>   
            </div>
            <div class="modal-body" style="overflow:auto;">
                <div class="col m6 l6 s6">
                    <p><strong style="font-weight: 700;">Categoria: </strong>{{$pro->categoria}}</p>
                    <p><strong style="font-weight: 700;">Precio: </strong>{{$pro->precio}}</p>
                    <p><strong style="font-weight: 700;">Descripcion: </strong><br>{{str_limit($pro->descripcion,180)}}</p>
                </div>
                <div class="col m6 l6 s6">
                    @if(!is_null($pro->foto))                    
                        <img src="img/productos/{{$pro->foto}}" style="max-width:100%;">
                    @else    
                        <img src="img/default.jpg" style="max-width:80%;">
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    
</div>