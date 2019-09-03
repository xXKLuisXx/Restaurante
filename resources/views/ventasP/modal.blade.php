<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$es->id_venta}}">
    {{Form::Open(array('action'=>array('VentaPublicoController@destroy',$es->id_venta),'method'=>'delete'))}}
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            <h4 class="modal-title">Eliminar Venta</h4>   
            </div>
            <div class="modal-body">
                 <p>Confirme si desea Eliminar La Venta</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    
    {{Form::Close()}}
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-ver-{{$es->id_venta}}">
    <div class="modal-dialog" style="width: auto; margin: auto auto; height: 100%; ">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            <h4 class="modal-title">Detalle de Venta</h4>   
            </div>
            <div class="modal-body" style="overflow:auto; max-height: 336px;">
                <table>
                    <thead>
                        <th>Producto</th>
                        <th>Tamaño</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        @foreach($productos as $det)
                            @if($det->id_venta == $es->id_venta)
                            <tr>
                            <td>{{$det->nombre}}</td>
                            <td>
                                @if($det->id_tamano == 1)
                                    Chico
                                @elseif($det->id_tamano == 2)
                                    Mediano
                                @elseif($det->id_tamano == 3)
                                    Grande
                                @endif
                            </td>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->precio_unitario}}</td>
                            <td>${{($det->cantidad)*($det->precio_unitario)}}</td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>