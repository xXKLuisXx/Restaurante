<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\venta;
use libreria\detalleventa;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\VentaForRequest;
use libreria\Http\Requests\DetalleVentaRequest;
use Auth;

use DB;

class VentaPublicoController extends Controller
{
     public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $ventas=DB::table('ventas as v')
                ->join('cliente as c', 'v.id_cliente','=','c.id_cliente')
                ->select('v.*','c.nombre as cliente')
                ->where('v.fecha','LIKE','%'.$query.'%')
                ->where('v.activo','=',1)
                ->where('v.id_cliente','=',Auth::user()->id_cliente)
                ->orderBy('v.id_venta','desc')
                ->paginate(12);
            $producto=DB::table('detalle_venta as dv')
                ->join('producto as p','p.id_producto','=','dv.id_producto')
                ->select('dv.*','p.*')
                ->where('dv.activo','=',1)
                ->orderBy('dv.id_detalleventa','desc')->get();
            return view('ventasP.index',["ventas"=>$ventas,"busqueda"=>$query,'productos'=>$producto]);
        }
    }
    public function create(){
        return view("ventasP.create");
    } 
    public function store(VentaForRequest $request){
        $ventas=new venta;
        $ventas->fecha=$request->get('fecha');
        $ventas->id_cliente=$request->get('id_cliente');
        $ventas->status=$request->get('status');
        $ventas->save();
        $id_venta=$ventas->id_venta;
        $productosCarrito=DB::table('detalle_venta as dv')
                ->join('producto as p','p.id_producto','=','dv.id_producto')
                ->select('dv.*','p.*')
                ->where('dv.activo','=',1)
                ->where('dv.id_venta','=',$id_venta)
                ->orderBy('dv.id_detalleventa','desc')->get();
        $producto=DB::table('producto as p')
                ->join('categorias as c', 'p.id_categoria','=','c.id_categoria')
                ->select('p.*', 'c.nombre as categoria')
                ->where('p.activo','=',1)
                ->orderBy('p.id_producto','desc')->get();
        return view('detalleCP.index',["venta"=>venta::findOrFail($id_venta),'productos'=>$productosCarrito,'id_venta'=>$id_venta,'disponibles'=>$producto]); 
    }
    public function show($id){
        //return view("ventasP.show",["venta"=>venta::findOrFail($id)]);
        $id_venta=$id;
        $venta=DB::table('ventas as c')
                ->join('cliente as p','p.id_cliente','=','c.id_cliente')
                ->select('c.monto as monto','c.fecha','c.id_venta as folio','p.nombre as nombreP','p.RFC as rfcP','p.telefono as telefonoP','p.e_mail as correoP')
                ->where('c.id_venta','=',$id_venta)->get();
        $productos=DB::table('detalle_venta as dv')
                ->join('producto as l','l.id_producto','=','dv.id_producto')
                ->select('dv.cantidad','dv.precio_unitario','l.nombre','l.id_producto as clave','dv.id_tamano')
                ->where('dv.activo','=',1)
                ->where('dv.id_venta','=',$id_venta)
                ->orderBy('dv.id_detalleventa','desc')->get();
        $view = view ('ventasP.show',['venta'=>$venta, 'productos'=>$productos]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        DB::select('CALL EfectuarVenta(?)', array($id));
        return $pdf->download('reporteVenta.pdf');
    }
    public function edit($id){
        $id_venta=$id;
        $productosCarrito=DB::table('detalle_venta as dv')
                ->join('producto as p','p.id_producto','=','dv.id_producto')
                ->select('dv.*','p.*')
                ->where('dv.activo','=',1)
                ->where('dv.id_venta','=',$id_venta)
                ->orderBy('dv.id_detalleventa','desc')->get();
        $producto=DB::table('producto as p')
                ->join('categorias as c', 'p.id_categoria','=','c.id_categoria')
                ->select('p.*', 'c.nombre as categoria')
                ->where('p.activo','=',1)
                ->orderBy('p.id_producto','desc')->get();
        $clientes=DB::table('cliente')->where('activo','=','1')->get();
        return view('ventasP.edit',['venta'=>venta::findOrFail($id),'clientes'=>$clientes,'disponibles'=>$producto,'id_venta'=>$id_venta,'productos'=>$productosCarrito]);
    }
    public function update(VentaForRequest $request,$id){
        $ventas=venta::findOrFail($id);
        $ventas->fecha=$request->get('fecha');
        $ventas->id_cliente=$request->get('id_cliente');
        $ventas->status=$request->get('status');
        $ventas->update();
        $id_venta=$id;
        $productosCarrito=DB::table('detalle_venta as dv')
                ->join('producto as p','p.id_producto','=','dv.id_producto')
                ->select('dv.*','p.*')
                ->where('dv.activo','=',1)
                ->where('dv.id_venta','=',$id_venta)
                ->orderBy('dv.id_detalleventa','desc')->get();
        $producto=DB::table('producto as p')
                ->join('categorias as c', 'p.id_categoria','=','c.id_categoria')
                ->select('p.*', 'c.nombre as categoria')
                ->where('p.activo','=',1)
                ->orderBy('p.id_producto','desc')->get();
        $clientes=DB::table('cliente')->where('activo','=','1')->get();
        return view('ventasP.edit',['venta'=>venta::findOrFail($id),'clientes'=>$clientes,'productos'=>$productosCarrito,'id_venta'=>$id_venta,'disponibles'=>$producto]);
    }
    public function destroy($id){
        $venta=venta::findOrFail($id);
        $venta->activo='0';
        $venta->update();
        return Redirect::to("ventasP");
    }
}
