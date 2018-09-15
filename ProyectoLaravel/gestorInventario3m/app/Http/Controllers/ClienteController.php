<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;
use gestorInventario3m\Http\Requests;
use gestorInventario3m\Cliente;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use gestorInventario3m\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController extends Controller
{
  public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $clientes=DB::table('cliente')     
            ->where('nombre','LIKE','%'.$query.'%')
            ->orwhere('cedula','LIKE','%'.$query.'%')
            ->orderBy('idCliente','asc')
            ->paginate(10);
            return view('ventas.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("ventas.cliente.create");
    }
    public function store (ClienteFormRequest $request)
    {
        $cliente=new Cliente;
        $cliente->nombre=$request->get('nombre');
        $cliente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->cedula=$request->get('cedula');
        $cliente->save();
        return Redirect::to('ventas/cliente');

    }
    public function show($id)
    {
        return view("ventas.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("ventas.cliente.edit",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function update(ClienteFormRequest $request,$id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->nombre=$request->get('nombre');
        $cliente->fecha_nacimiento=$request->get('fecha_nacimiento');
        $cliente->telefono=$request->get('telefono');
        $cliente->email=$request->get('email');
        $cliente->cedula=$request->get('cedula');
        $cliente->update();
        return Redirect::to('ventas/cliente');
    }
    public function destroy($id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->delete($id);
        return Redirect::to('ventas/cliente');
    }




}
