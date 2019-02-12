<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\ProductoFormRequest;
use gestorInventario3m\Producto;
use DB;

use Fpdf;

class ProductoController extends Controller
{
     public function __construct()
    {
       //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $productos=DB::table('Producto as p')
            ->join('categoria as cat','p.idcategoria','=','cat.idcategoria')
            ->select('p.idproducto','cat.nombre as categoria','p.nombre','p.marca','p.precio','p.descripcion','p.imagen')
            ->where('p.nombre','LIKE','%'.$query.'%')
            ->orderBy('p.idproducto','asc')
            ->paginate(10);
            return view('almacen.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	$categorias=DB::table('categoria')->get();
        return view("almacen.producto.create",["categorias"=>$categorias]);
    }
    public function store (ProductoFormRequest $request)
    {
        $producto=new Producto;
        $producto->idcategoria=$request->get('idcategoria');
        $producto->nombre=$request->get('nombre');
        $producto->marca=$request->get('marca');
        $producto->precio=$request->get('precio');
        $producto->descripcion=$request->get('descripcion');

        if (Input::hasFile('imagen')) {
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
        	$producto->imagen=$file->getClientOriginalName();
        }

        $producto->save();
        return Redirect::to('almacen/producto');

    }
    public function show($id)
    {
        return view("almacen.producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    public function edit($id)
    {
    	$producto=Producto::findOrFail($id);
    	$categorias=DB::table('categoria')->get();

        return view("almacen.producto.edit",["producto"=>$producto,"categorias"=>$categorias]);
    }
    public function update(ProductoFormRequest $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->idcategoria=$request->get('idcategoria');
        $producto->nombre=$request->get('nombre');
        $producto->marca=$request->get('marca');
        $producto->precio=$request->get('precio');
        $producto->descripcion=$request->get('descripcion');

        if (Input::hasFile('imagen')) {
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
        	$producto->imagen=$file->getClientOriginalName();
        }

        $producto->update();
        return Redirect::to('almacen/producto');
    }
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->delete($id);
        return Redirect::to('almacen/producto');
    }

    public function reporte(){
        $registros=DB::table('Producto as p')
            ->join('categoria as cat','p.idcategoria','=','cat.idcategoria')
            ->select('p.idproducto','cat.nombre as categoria','p.nombre','p.marca','p.precio','p.descripcion','p.imagen')
            ->orderBy('p.idproducto','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Productos"),0,"","C");
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(47,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(47,8,utf8_decode("Categoría"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Marca"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Precio"),1,"","L",true);

         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont('Arial','B',9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(47,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(47,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(45,6,utf8_decode($reg->marca),1,"","L",true);
            $pdf::cell(45,6,utf8_decode($reg->precio),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}
