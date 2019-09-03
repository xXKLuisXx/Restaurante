<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\editorial;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\EditorialFormRequest;

use DB;

class EditorialController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $editorial=DB::table('editorial')->where('nombre','LIKE','%'.$query.'%')
            ->orWhere('encargado','LIKE','%'.$query.'%')
            ->where('activo','=',1)
                ->orderBy('id_editorial','desc')
                ->paginate(12);
            return view('editorial.index',["editorial"=>$editorial,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("editorial.create");
    } 
    public function store(EditorialFormRequest $request){
        $editorial=new editorial;
        $editorial->nombre=$request->get('nombre');
        $editorial->encargado=$request->get('encargado');
        $editorial->e_mail=$request->get('e_mail');
        $editorial->rfc=$request->get('rfc');
        $editorial->save();
        return Redirect::to('editorial');
    }
    public function show($id){
        return view("editorial.show",["editorial"=>editorial::findOrFail($id)]);
    }
    public function edit($id){
        return view("editorial.edit",["editorial"=>editorial::findOrFail($id)]);
    }
    public function update(EditorialFormRequest $request,$id){
        $editorial=editorial::findOrFail($id);
        $editorial->nombre=$request->get('nombre');
        $editorial->e_mail=$request->get('e_mail');
        $editorial->rfc=$request->get('rfc');
        $editorial->update();
        return Redirect::to("editorial");
    }
    public function destroy($id){
        $editorial=editorial::findOrFail($id);
        $editorial->activo='0';
        $editorial->update();
        return Redirect::to("editorial");
    }
}
