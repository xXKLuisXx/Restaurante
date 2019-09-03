<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\detalleventa;
use libreria\venta;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\DetalleVentaRequest;
use libreria\Http\Requests\VentaForRequest;
use libreria\productos;

use DB;

class DetalleVentaController extends Controller
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
                ->orderBy('v.id_venta','desc')
                ->paginate(12);
            $producto=DB::table('detalle_venta as dv')
                ->join('producto as p','p.id_producto','=','dv.id_producto')
                ->select('dv.*','p.*')
                ->where('dv.activo','=',1)
                ->orderBy('dv.id_detalleventa','desc')->get();
            return view('ventas.index',["ventas"=>$ventas,"busqueda"=>$query,'productos'=>$producto]);
        }
    }
    public function create(){
        $clientes=DB::table('cliente')->where('activo','=','1')->get();
        return view("ventas.create",['clientes'=>$clientes]);
    } 
    public function store(DetalleVentaRequest $request){
        $ventasd=new detalleventa;
        $ventasd->id_venta=$request->get('id_venta');
        $ventasd->id_producto=$request->get('id_producto');
        $ventasd->cantidad = $request->get('cantidad');
        $ventasd->id_tamano = $request->get('id_tamano');
        $producto=productos::findOrFail($request->get('id_producto'));
        $ventasd->precio_unitario=($request->get('id_tamano')*$producto->precio);
        $ventasd->save();
        $id_venta=$request->get('id_venta');
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
        return view('detalle.index',['clientes'=>$clientes,'venta'=>venta::findOrFail($id_venta),'disponibles'=>$producto,'id_venta'=>$id_venta,'productos'=>$productosCarrito]); 
    }
    public function show($id){
        return view("detalle.show",["detalle"=>detalleventa::findOrFail($id)]);
    }
    public function edit($id){
        $producto=DB::table('producto as p')
                ->join('categorias as c', 'p.id_categoria','=','c.id_categoria')
                ->select('p.*', 'c.nombre as categoria')
                ->where('p.activo','=',1)
                ->orderBy('p.id_producto','desc')->get();
        return view("detalle.edit",["venta"=>detalleventa::findOrFail($id),'disponibles'=>$producto]);
    }
    public function update(DetalleVentaRequest $request,$id){
        $ventasd=detalleventa::findOrFail($id);
        $ventasd->id_venta=$request->get('id_venta');
        $ventasd->id_producto=$request->get('id_producto');
        $ventasd->cantidad=$request->get('cantidad');
        $ventasd->id_tamano = $request->get('id_tamano');
        $producto=productos::findOrFail($request->get('id_producto'));
        $ventasd->precio_unitario=($request->get('id_tamano')*$producto->precio);
        $ventasd->update();
        
        $id_venta=$request->get('id_venta');
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
        return view('detalle.index',['clientes'=>$clientes,'venta'=>venta::findOrFail($id_venta),'disponibles'=>$producto,'id_venta'=>$id_venta,'productos'=>$productosCarrito]); 
    }
    public function destroy($id){
        $venta=detalleventa::findOrFail($id);
        $venta->activo='0';
        $venta->update();
        $id_venta=$venta->id_venta;
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
        DB::select('CALL actualizaVentaEliminarDetalle(?,?)', array($venta->cantidad*$venta->precio_unitario, $id_venta));
        return view('detalle.index',['clientes'=>$clientes,'venta'=>venta::findOrFail($id_venta),'disponibles'=>$producto,'id_venta'=>$id_venta,'productos'=>$productosCarrito]); 
    }
}
