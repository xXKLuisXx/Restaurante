<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\User;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\UsuarioRequest;

use DB;

class UsuarioController extends Controller
{
    public function __contructor(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $usuario=DB::table('users')->where('name','LIKE','%'.$query.'%')
                ->orderBy('id','desc')
                ->paginate(12);
            return view('usuario.index',["usuarios"=>$usuario,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("usuario.create");
    } 
    public function store(UsuarioRequest $request){
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->roll=$request->get('roll');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->save();
        //DB::select('CALL conectaIdUserClient(?)', array($usuario->id_cliente));
        return Redirect::to('usuario');
    }
    public function show($id){
        return view("autor.show",["autor"=>autor::findOrFail($id)]);
    }
    public function edit($id){
        return view("usuario.edit",["usuario"=>User::findOrFail($id)]);
    }
    public function update(UsuarioRequest $request,$id){
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->roll=$request->get('roll');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
        return Redirect::to("usuario");
    }
    public function destroy($id){
        $usuario=User::findOrFail($id);
        if($usuario->roll == 1){
            DB::select('CALL eliminarCliente(?)', array($usuario->id_cliente));
        }
        $usuario=DB::table('users')->where('id','=',$id)->delete();
        return Redirect::to("usuario");
    }
}
