<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\productos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use libreria\Http\Requests\ProductoFormRequest;
use DB;

class ProductoController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $producto=DB::table('producto as p')
                ->join('categorias as c', 'p.id_categoria','=','c.id_categoria')
                ->select('p.*', 'c.nombre as categoria')
                ->where('p.nombre','LIKE','%'.$query.'%')
                ->where('p.activo','=',1)
                ->orderBy('p.id_producto','desc')
                ->paginate(12);
            return view('menu.index',["productos"=>$producto,"busqueda"=>$query]);
        }
    }
    public function create(){
        $categoria=DB::table('categorias')->where('activo','=','1')->get();
        $ingrediente=DB::table('ingrediente')->where('activo','=','1')->get();
        return view("menu.create",['categorias'=>$categoria,'ingredientes'=>$ingrediente]);
    } 
    public function store(ProductoFormRequest $request){
        $producto=new productos;
        $producto->nombre=$request->get('nombre');
        $producto->id_categoria=$request->get('id_categoria');
        $producto->descripcion=$request->get('descripcion');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/img/productos/',$file->getClientOriginalName());
            $producto->foto=$file->getClientOriginalName();
        }
        $producto->precio=$request->get('precio');
        $producto->save();
        return Redirect::to('menu');
    }
    public function show($id){
        return view("menu.show",["producto"=>productos::findOrFail($id)]);
    }
    public function edit($id){
        $categoria=DB::table('categorias')->where('activo','=','1')->get();
        $ingrediente=DB::table('ingrediente')->where('activo','=','1')->get();
        return view("menu.edit",["producto"=>productos::findOrFail($id),"categorias"=>$categoria,"ingredientes"=>$ingrediente]);
    }
    public function update(ProductoFormRequest $request,$id){
        $producto=productos::findOrFail($id);
        $producto->nombre=$request->get('nombre');
        $producto->id_categoria=$request->get('id_categoria');
        $producto->descripcion=$request->get('descripcion');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/img/productos/',$file->getClientOriginalName());
            $producto->foto=$file->getClientOriginalName();
        }
        $producto->precio=$request->get('precio');
        $producto->update();
        return Redirect::to("menu");
    }
    public function destroy($id){
        $producto=productos::findOrFail($id);
        $producto->activo='0';
        $producto->update();
        return Redirect::to("menu");
    }
}
