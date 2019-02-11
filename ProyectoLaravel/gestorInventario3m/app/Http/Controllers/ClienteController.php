<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;
use gestorInventario3m\Http\Requests;
use gestorInventario3m\Cliente;
use Illuminate\Support\Facades\Redirect;
use gestorInventario3m\Http\Requests\ClienteFormRequest;
use DB;

use Fpdf;


class ClienteController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
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

    public function reporte(){
         //Obtenemos los registros
        $registros=DB::table('cliente')    
            ->orderBy('idCliente','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Clientes"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(60,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Documento"),1,"","L",true);
         $pdf::cell(55,8,utf8_decode("Email"),1,"","L",true);
         $pdf::cell(30,8,utf8_decode("Teléfono"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(60,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(45,6,utf8_decode($reg->cedula),1,"","L",true);
            $pdf::cell(55,6,utf8_decode($reg->email),1,"","L",true);
            $pdf::cell(30,6,utf8_decode($reg->telefono),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }


}
