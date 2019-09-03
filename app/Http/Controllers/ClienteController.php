<?php

namespace libreria\Http\Controllers;

use Illuminate\Http\Request;
use libreria\clientes;
use Illuminate\Support\Facades\Redirect;
use libreria\Http\Requests\ClienteRequest;
use Auth;
use libreria\User;
use DB;

class ClienteController extends Controller
{
    public function __contructor(){
        
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('busqueda'));
            $clientes=DB::table('cliente as p')
            //->join('venta as c','c.id_cliente','=','p.id_cliente')
            ->select('p.*') //DB::raw("ifnull(count(c.id_cliente),0) as compras"))
            //->where('c.activo','=',1)
            ->where('p.nombre','LIKE','%'.$query.'%')
            ->where('p.activo','=',1)
                ->groupBy('p.id_cliente')
                ->orderBy('p.id_cliente','desc')
                ->paginate(12);
            return view('clientes.index',["clientes"=>$clientes,"busqueda"=>$query]);
        }
    }
    public function create(){
        return view("clientes.create");
    } 
    public function store(ClienteRequest $request){
        $clientes=new clientes;
        $clientes->nombre=$request->get('nombre');
        $clientes->apellido=$request->get('apellido');
        $clientes->usuario=$request->get('usuario');
        $clientes->contrasena=bcrypt($request->get('contrasena'));
        $clientes->rfc=$request->get('RFC');
        $clientes->domicilio=$request->get('domicilio');
        $clientes->telefono=$request->get('telefono');
        $clientes->e_mail=$request->get('correo');
        $clientes->save();
        if(Auth::user()->id_cliente == -1 and Auth::user()->roll == 1){
            $usuario=DB::table('users')->where('id_cliente','=',$clientes->id_cliente)->delete();
            $usuario=User::findOrFail(Auth::user()->id);
            $usuario->id_cliente = $clientes->id_cliente;
            $usuario->update();
            $cliente=clientes::findOrFail($usuario->id_cliente);
            $cliente->e_mail=Auth::user()->email;
            $cliente->update();
            //Auth::user()->id_cliente = $clientes->id_cliente;
            return Redirect::to('ventasP');
        }
        else{
            return Redirect::to('clientes');
        }   
        //DB::select('CALL conectaIdUserClient(?)', array($clientes->id_cliente));
    }
    public function show($id){
        return view("clientes.show",["cliente"=>clientes::findOrFail($id)]);
    }
    public function edit($id){
        return view("clientes.edit",["cliente"=>clientes::findOrFail($id)]);
    }
    public function update(ClienteRequest $request,$id){
        $clientes=clientes::findOrFail($id);
        $clientes->nombre=$request->get('nombre');
        $clientes->apellido=$request->get('apellido');
        $clientes->usuario=$request->get('usuario');
        $clientes->contrasena=bcrypt($request->get('contrasena'));
        $clientes->rfc=$request->get('RFC');
        $clientes->domicilio=$request->get('domicilio');
        $clientes->telefono=$request->get('telefono');
        $clientes->e_mail=$request->get('correo');
        $clientes->update();
        return Redirect::to("clientes");
    }
    public function destroy($id){
        $clientes=clientes::findOrFail($id);
        $clientes->activo='0';
        $clientes->update();
        DB::select('CALL eliminarUser(?)', array($id));            
        return Redirect::to("clientes");
    }
}
