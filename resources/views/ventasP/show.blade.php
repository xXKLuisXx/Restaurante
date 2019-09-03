<html>
    <head></head>
<body>
    <style>
    .conBorde{
        border: 1px #4b5052 solid;
        overflow: auto;
        margin: 2px;
    }
    .gris{
        background: #f3f4f5;
    }
        table.border {
    border-left: 0.01em solid #ccc;
    border-right: 0;
    border-top: 0.01em solid #ccc;
    border-bottom: 0;
    border-collapse: collapse;
        }
        table.border td,
    table.border th {
        border-left: 0;
        border-right: 0.01em solid #ccc;
        border-top: 0;
        border-bottom: 0.01em solid #ccc;
    }
        .sinBorde{
            border-left: 0 !important;
            border-right: 0.0em solid #ccc !important;
            border-top: 0 !important;
            border-bottom: 0.00em solid #ccc !important;
        }
    </style>
    
    <table  style="width: 100%">
        <tr>
            <td style="width: 100%">
                <table>
                    <tr>
                        <td>
                            <strong> Folio: </strong>
                            {{$venta[0]->folio}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong> Fecha: </strong>
                            {{$venta[0]->fecha}}
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: auto;">
                <img src="{{asset('img/logo.JPG')}}" style="max-width: 250px;">
            </td>
        </tr>
        <tr>
            <td style="width: 50%">
                <table style="width: 100%">
                <tr>
                    <td>
                    <strong>Datos del Cliente: </strong><br>
                    <strong> RFC: </strong>{{$venta[0]->rfcP}}<br>
                    <strong> Nombre: </strong>{{$venta[0]->nombreP}}<br>
                    <strong> Correo Eléctronico:</strong> {{$venta[0]->correoP}}<br>
                    <strong> Teléfono: </strong>{{$venta[0]->telefonoP}}<br>
                    </td>
                </tr>
                </table>
            </td>
            <td style="width: 50%">
                <table style="width: 100%">
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="col l12 m12 s12 lx12">
        <h3 style="margin-top: 43px;">Resumen</h3>

        @if((count($productos)>0))
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <table class="border" style="width:100%;">
                    <tr class="gris" style="border: 1px #4b5052 solid;">
                        <th>Producto</th>
                        <th>Tamaño</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                        @foreach($productos as $det)
                        <tr  style="border: 1px #4b5052 solid;">
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
                        @endforeach
                        <tr class="sinBorde">
                            <td class="sinBorde"></td><td class="sinBorde"></td><td class="sinBorde"></td><td class="gris">Subtotal</td><td>${{$venta[0]->monto}}</td>
                        </tr>
                        <tr class="sinBorde">
                            <td class="sinBorde"></td><td class="sinBorde"></td><td class="sinBorde"></td><td class="gris">Impuestos</td><td>${{($venta[0]->monto)*(0.16)}}</td>
                        </tr>
                        <tr class="sinBorde">
                            <td class="sinBorde"></td><td class="sinBorde"></td><td class="sinBorde"></td><td class="gris">Total</td><td>${{($venta[0]->monto)+(($venta[0]->monto)*(0.16))}}</td>
                        </tr>
                 </table>
                
        </div>
        @endif
    </div>
</body>
</html