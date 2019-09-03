<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\categorias;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use libreria\Http\Requests\categoriaRequest;
use DB;

class CategoriaController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $categorias=DB::table('categorias')->where('nombre','LIKE','%'.$query.'%')
                ->where('activo','=',1)
                ->orderBy('id_categoria','desc')
                ->paginate(12);
            return view('categorias.index',["categorias"=>$categorias,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("categorias.create");
    } 
    public function store(CategoriaRequest $request){
        $categoria=new categorias;
        $categoria->nombre=$request->get('nombre');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/img/categorias/',$file->getClientOriginalName());
            $categoria->imagen=$file->getClientOriginalName();
        }
        $categoria->save();
        return Redirect::to('categorias');
    }
    public function show($id){
        return view("categorias.show",["categoria"=>categorias::findOrFail($id)]);
    }
    public function edit($id){
        return view("categorias.edit",["categoria"=>categorias::findOrFail($id)]);
    }
    public function update(CategoriaRequest $request,$id){
        $categoria=categorias::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/img/categorias/',$file->getClientOriginalName());
            $categoria->image=$file->getClientOriginalName();
        }
        $categoria->update();
        return Redirect::to("categorias");
    }
    public function destroy($id){
        $categoria=categorias::findOrFail($id);
        $categoria->activo='0';
        $categoria->update();
        return Redirect::to("categorias");
    }
}
