<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\autor;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\AutorForRequest;

use DB;

class AutorController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $autor=DB::table('autor')->where('nombre','LIKE','%'.$query.'%')
            ->where('activo','=',1)
                ->orderBy('id_autor','desc')
                ->paginate(12);
            return view('autor.index',["autor"=>$autor,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("autor.create");
    } 
    public function store(AutorForRequest $request){
        $autor=new autor;
        $autor->nombre=$request->get('nombre');
        $autor->biografia=$request->get('biografia');
        $autor->save();
        return Redirect::to('autor');
    }
    public function show($id){
        return view("autor.show",["autor"=>autor::findOrFail($id)]);
    }
    public function edit($id){
        return view("autor.edit",["autor"=>autor::findOrFail($id)]);
    }
    public function update(AutorForRequest $request,$id){
        $autor=autor::findOrFail($id);
        $autor->nombre=$request->get('nombre');
        $autor->biografia=$request->get('biografia');
        $autor->update();
        return Redirect::to("autor");
    }
    public function destroy($id){
        $autor=autor::findOrFail($id);
        $autor->activo='0';
        $autor->update();
        return Redirect::to("autor");
    }
}
