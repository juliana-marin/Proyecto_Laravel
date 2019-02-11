<?php
namespace gestorInventario3m\Http\Controllers;
use Illuminate\Http\Request;
use gestorInventario3m\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\InventarioFormRequest;
use gestorInventario3m\Inventario;
use DB;

use Fpdf;

class InventarioController extends Controller
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
            $inventarios=DB::table('inventario as inv')
            ->join('producto as prod','inv.idproducto','=','prod.idproducto')
            ->select('inv.idinventario','prod.nombre as producto','inv.cant_producto_ingreso','inv.cant_producto_vendido','inv.cant_producto_restante',
                'inv.precio')
            ->where('inv.idinventario','LIKE','%'.$query.'%')
            ->orderBy('inv.idinventario','asc')
            ->paginate(10);
            return view('inventarioProducto.inventario.index',["inventarios"=>$inventarios,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $productos=DB::table('producto')->get();
       return view("inventarioProducto.inventario.create",["productos"=>$productos]);
    }
    public function store (InventarioFormRequest $request)
    {
        $inventario=new Inventario;
        $inventario->idproducto=$request->get('idproducto');
        $inventario->cant_producto_ingreso=$request->get('cant_producto_ingreso');
        $inventario->cant_producto_vendido=$request->get('cant_producto_vendido');
        $inventario->cant_producto_restante=$request->get('cant_producto_restante');
        $inventario->precio=$request->get('precio');
        $inventario->save();
        return Redirect::to('inventarioProducto/inventario');
    }
    public function show($id)
    {
        return view("inventarioProducto.inventario.show",["inventario"=>Inventario::findOrFail($id)]);
    }
    public function edit($id)
    {
        $inventario=Inventario::findOrFail($id);
        $productos=DB::table('producto')->get();
        return view("inventarioProducto.inventario.edit",["inventario"=>$inventario,"productos"=>$productos]);
    }
    public function update(InventarioFormRequest $request,$id)
    {
        $inventario=Inventario::findOrFail($id);
        $inventario->idproducto=$request->get('idproducto');
        $inventario->cant_producto_ingreso=$request->get('cant_producto_ingreso');
        $inventario->cant_producto_vendido=$request->get('cant_producto_vendido');
        $inventario->cant_producto_restante=$request->get('cant_producto_restante');
        $inventario->precio=$request->get('precio');
        $inventario->update();
        return Redirect::to('inventarioProducto/inventario');
    }
    public function destroy($id)
    {
        $inventario=Inventario::findOrFail($id);
        $inventario->delete($id);
        return Redirect::to('inventarioProducto/inventario');
    }

    public function reporte(){
     $registros=DB::table('inventario as inv')
            ->join('producto as prod','inv.idproducto','=','prod.idproducto')
            ->select('inv.idinventario','prod.nombre as producto','inv.cant_producto_ingreso','inv.cant_producto_vendido','inv.cant_producto_restante',
                'inv.precio')
            ->orderBy('inv.idinventario','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado inventarios"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(45,8,utf8_decode("Producto"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Cant. ingresados"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Cant. vendidos"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Cant. restante"),1,"","L",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","R",true);

         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(45,6,utf8_decode($reg->producto),1,"","L",true);
            $pdf::cell(40,6,utf8_decode($reg->cant_producto_ingreso),1,"","L",true);
            $pdf::cell(40,6,utf8_decode($reg->cant_producto_vendido),1,"","L",true);
            $pdf::cell(40,6,utf8_decode($reg->cant_producto_restante),1,"","L",true);
            $pdf::cell(25,6,utf8_decode($reg->cant_producto_vendido*$reg->precio),1,"","R",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
}
