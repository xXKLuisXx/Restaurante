<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\genero;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\GeneroFormRequest;

use DB;

class GeneroController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $genero=DB::table('genero')->where('nombre','LIKE','%'.$query.'%')
            ->where('activo','=',1)
                ->orderBy('id_genero','desc')
                ->paginate(12);
            return view('genero.index',["genero"=>$genero,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("genero.create");
    } 
    public function store(GeneroFormRequest $request){
        $genero=new genero;
        $genero->nombre=$request->get('nombre');
        $genero->save();
        return Redirect::to('genero');
    }
    public function show($id){
        return view("genero.show",["genero"=>genero::findOrFail($id)]);
    }
    public function edit($id){
        return view("genero.edit",["genero"=>genero::findOrFail($id)]);
    }
    public function update(GeneroFormRequest $request,$id){
        $genero=genero::findOrFail($id);
        $genero->nombre=$request->get('nombre');
        $genero->update();
        return Redirect::to("genero");
    }
    public function destroy($id){
        $genero=genero::findOrFail($id);
        $genero->activo='0';
        $genero->update();
        return Redirect::to("genero");
    }
}
