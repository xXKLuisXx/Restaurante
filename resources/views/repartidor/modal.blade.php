<style>
    td{
        padding: 5px 5px !important;
    }
</style>
 <table>
     <thead>
         <th>Listo</th>
         <th>Producto</th>
         <th>Tamaño</th>
         <th>Cantidad</th>
     </thead>
     <tbody>
         @foreach($productos as $det)
             @if($det->id_venta == $es->id_venta)
             <tr>
                 <td>
                    <p style="height: 10px;">
                      <input type="checkbox" class="filled-in" id="filled-in-box{{$det->id_detalleventa}}"/>
                      <label for="filled-in-box{{$det->id_detalleventa}}"></label>
                    </p>
                 </td>
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
             </tr>
             @endif
       @endforeach
     </tbody>
 </table>
            