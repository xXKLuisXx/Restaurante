<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\estante;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use libreria\Http\Requests\EstanteFormRequest;
use DB;

class EstanteController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $estante=DB::table('libro as l')
                ->join('autor as a', 'l.id_autor','=','a.id_autor')
                ->select('l.*', 'a.nombre as autor')
                ->where('l.titulo','LIKE','%'.$query.'%')
                ->where('l.activo','=',1)
                ->orderBy('l.id','desc')
                ->paginate(12);
            return view('estante.index',["libros"=>$estante,"busqueda"=>$query]);
        }
    }
    public function create(){
        $autor=DB::table('autor')->where('activo','=','1')->get();
        $genero=DB::table('genero')->where('activo','=','1')->get();
        $editorial=DB::table('editorial')->where('activo','=','1')->get();
        return view("estante.create",['autores'=>$autor,'generos'=>$genero,'editoriales'=>$editorial]);
    } 
    public function store(EstanteFormRequest $request){
        $estante=new estante;
        $estante->titulo=$request->get('titulo');
        $estante->edicion=$request->get('edicion');
        $estante->precio=$request->get('precio');
        $estante->id_autor=$request->get('id_autor');
        $estante->existencia=$request->get('existencia');
        $estante->descripcion=$request->get('descripcion');
        $estante->id_genero=$request->get('id_genero');
        $estante->id_editorial=$request->get('id_editorial');
        $estante->fecha=$request->get('fecha');
        $estante->fecha_registros=$request->get('fecha_registros');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/img/libros/',$file->getClientOriginalName());
            $estante->foto=$file->getClientOriginalName();
        }
        $estante->save();
        return Redirect::to('estante');
    }
    public function show($id){
        return view("estante.show",["estante"=>estante::findOrFail($id)]);
    }
    public function edit($id){
        $autor=DB::table('autor')->where('activo','=','1')->get();
        $genero=DB::table('genero')->where('activo','=','1')->get();
        $editorial=DB::table('editorial')->where('activo','=','1')->get();
        return view("estante.edit",["estante"=>estante::findOrFail($id),"autores"=>$autor,"editoriales"=>$editorial,"generos"=>$genero]);
    }
    public function update(EstanteFormRequest $request,$id){
        $estante=estante::findOrFail($id);
        $estante->titulo=$request->get('titulo');
        $estante->edicion=$request->get('edicion');
        $estante->precio=$request->get('precio');
        $estante->id_autor=$request->get('id_autor');
        $estante->existencia=$request->get('existencia');
        $estante->descripcion=$request->get('descripcion');
        $estante->id_genero=$request->get('id_genero');
        $estante->id_editorial=$request->get('id_editorial');
        $estante->fecha=$request->get('fecha');
        $estante->fecha_registros=$request->get('fecha_registros');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/imagenes/libros/',$file->getClientOriginalName());
            $estante->foto=$file->getClientOriginalName();
        }
        $estante->update();
        return Redirect::to("estante");
    }
    public function destroy($id){
        $estante=estante::findOrFail($id);
        $estante->activo='0';
        $estante->update();
        return Redirect::to("estante");
    }
}
