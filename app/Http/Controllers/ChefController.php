<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\venta;
use libreria\detalleventa;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\VentaForRequest;
use libreria\Http\Requests\DetalleVentaRequest;
use DB;

class ChefController extends Controller
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
            return view('chef.index',["ventas"=>$ventas,"busqueda"=>$query,'productos'=>$producto]);
        }
    }
    public function create(){
        //
    } 
    public function store(VentaForRequest $request){
        //
    }
    public function show($id){
        //
    }
    public function edit($id){
        $venta=venta::findOrFail($id);
        $venta->status='3';
        $venta->update();
        return Redirect::to("chef");
    }
    public function update(VentaForRequest $request,$id){
        //
    }
    public function destroy($id){
        //
    }
}
