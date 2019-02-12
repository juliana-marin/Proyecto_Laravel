<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\VentaFormRequest;
use gestorInventario3m\Venta;
use gestorInventario3m\DetalleVenta;
use DB;

use Fpdf;


use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
 public function __construct()
    {
      $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
    	if ($request){
    		$query=trim($request->get('searchText'));
    		$ventas=DB::table('venta as v')
          ->join('cliente as c','v.idcliente','=','c.idCliente')
          ->join('inventario as inv','v.idinventario','=','inv.idinventario')
    		  ->join('detalle_venta as dv','v.idVenta','=','dv.idventa')
    		  ->select('v.idVenta','c.nombre','inv.idinventario','v.fecha','v.valor_total','v.estado_venta')
    		  ->where('v.idVenta','LIKE','%'.$query.'%')
    		  ->orderBy('v.idVenta','asc')
    		  ->groupBy('v.idVenta','c.nombre','inv.idinventario','v.fecha','v.valor_total','v.estado_venta')
    		  ->paginate(10);
    		  return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
      $clientes=DB::table('cliente')->get();
      $inventarios=DB::table('inventario')->get();
      $productos=DB::table('producto as pro')
    		->select(DB::raw('CONCAT(pro.nombre," ",pro.marca) AS producto'),'pro.idproducto','pro.precio')
    		->get();
        return view("ventas.venta.create",["clientes"=>$clientes,"productos"=>$productos,"inventarios"=>$inventarios]);
    }

     public function store (VentaFormRequest $request)
    {
    	
    		DB::beginTransaction();
    	  $venta=new Venta;
       	$venta->idcliente=$request->get('idcliente');
       	$venta->idinventario=$request->get('idinventario');
       	$mytime = Carbon::now('America/Bogota');
       	$venta->fecha=$mytime->toDateTimeString();
       	$venta->valor_total=$request->get('valor_total');
       	$venta->estado_venta=$request->get('estado_venta');
       	$venta->save();

       	$idproducto=$request->get('idproducto');
       	$cantidad=$request->get('cantidad');
       	$precio=$request->get('precio');
       	$impuesto=$request->get('impuesto');
       	$descripcion=$request->get('descripcion');
       	$descuento=$request->get('descuento');

       	$cont = 0;

       		while ($cont < cont($idproducto)) {
       			$detalle = new DetalleVenta();
            $detalle->idproducto=$idproducto[$cont];
       			$detalle->idventa=$venta->idVenta;
       			$detalle->cantidad= $cantidad[$cont];
       			$detalle->precio=$precio[$cont];
       			$detalle->impuesto=$impuesto[$cont];
       			$detalle->descripcion=$descripcion[$cont];
       			$detalle->descuento=$descuento[$cont];
       			$detalle->save();
       			$cont=$cont+1;
       		}

    	
        return Redirect::to('ventas/venta');

    }


     public function show($id)
    {
    	$venta=DB::table('venta as v')
        ->join('cliente as c','v.idcliente','=','c.idcliente')
            ->join('inventario as inv','v.idinventario','=','inv.idinventario')
    		->join('detalle_venta as dv','v.idVenta','=','dv.idventa')
    		->select('v.idVenta','c.nombre','inv.idinventario','v.fecha','v.valor_total','v.estado_venta')
    		->where('v.idVenta','=',$id)
    		->first();

    	$detalles=DB::table('detalle_venta as dv')
    	  ->join('producto as pro','dv.idproducto','=','pro.idproducto')
    		->select('pro.nombre as producto','dv.cantidad','dv.precio','dv.impuesto','dv.descripcion','dv.descuento')
    		->where('dv.idventa','=',$id)
    		->get();

        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);

    }

     public function edit($id)
    {
        return view("ventas.venta.edit",["venta"=>Venta::findOrFail($id)]);
    }

    public function update(VentaFormRequest $request,$id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado_venta=$request->get('estado_venta');
        $venta->update();
        return Redirect::to('ventas/venta');
    }


     public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado_venta='Cancelado';
        $venta->update();
        return Redirect::to('ventas/venta');
    }
 public function reportec($id){
      $ventas=DB::table('venta as v')
          ->join('cliente as c','v.idcliente','=','c.idCliente')
          ->join('inventario as inv','v.idinventario','=','inv.idinventario')
          ->join('detalle_venta as dv','v.idVenta','=','dv.idventa')
          ->select('v.idVenta','c.nombre','c.telefono','c.email','inv.idinventario','v.fecha','v.valor_total','v.estado_venta')
          ->orderBy('v.idVenta','asc')
          ->first();


      $detalles=DB::table('detalle_venta as dv')
        ->join('producto as pro','dv.idproducto','=','pro.idproducto')
        ->select('pro.nombre as producto','dv.cantidad','dv.precio','dv.impuesto','dv.descripcion','dv.descuento')
        ->where('dv.idventa','=',$id)
        ->get();

        $pdf = new Fpdf();
        $pdf::AddPage();
        $pdf::SetFont('Arial','B',12);
        //Inicio con el reporte
        $pdf::SetXY(30,20);
        $pdf::Cell(0,0,utf8_decode($ventas->nombre));
        $pdf::SetXY(100,20);
        $pdf::Cell(0,0,utf8_decode($ventas->telefono));
        $pdf::SetXY(150,20);
        $pdf::Cell(0,0,utf8_decode($ventas->email));

        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(30,30);
        $pdf::Cell(0,0,utf8_decode($ventas->idinventario));

        $pdf::SetFont('Arial','B',10);
        $pdf::SetXY(30,50);
        $pdf::Cell(0,0,utf8_decode($ventas->fecha));
        $pdf::SetXY(30,59);
        $pdf::Cell(0,0,utf8_decode($ventas->valor_total));
        //***Parte de la derecha
        $pdf::SetXY(30,68);
        $pdf::Cell(0,0,utf8_decode($ventas->estado_venta));
        
        $total=0;         
         //Mostramos los detalles
        $y=79;
        foreach($detalles as $det){

            $pdf::SetXY(30,$y);
            $pdf::MultiCell(25,0,utf8_decode($det->producto));

            $pdf::SetXY(100,$y);
            $pdf::MultiCell(20,0,utf8_decode($det->cantidad));

            $pdf::SetXY(150,$y);
            $pdf::MultiCell(25,0,$det->precio);

            $pdf::SetXY(162,$y);
            $pdf::MultiCell(25,0,$det->precio-$det->descuento);

            $pdf::SetXY(187,$y);
            $pdf::MultiCell(25,0,sprintf("%0.0F",(($det->precio-$det->descuento)*$det->cantidad)));

            $total=$total+(($det->precio-$det->descuento)*$det->cantidad);
            $y=$y+7;
        }

        $pdf::SetXY(187,100);
        $pdf::MultiCell(20,0,"$ ".sprintf("%0.0F", ($ventas->valor_total)));

        $pdf::Output();
        exit;
    }


    public function reporte(){
         //Obtenemos los registros
          $registros=DB::table('venta as v')
            ->join('cliente as c','v.idcliente','=','c.idcliente')
            ->join('inventario as inv','v.idinventario','=','inv.idinventario')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idVenta','c.nombre','inv.idinventario','v.fecha','v.estado_venta','v.valor_total')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idVenta','c.nombre','inv.idinventario','v.fecha','v.estado_venta','v.valor_total')
            ->get();

         //Ponemos la hoja Horizontal (L)
         $pdf = new Fpdf('L','mm','A4');
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Ventas"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(45,8,utf8_decode("Cliente"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Inventario"),1,"","C",true);
         $pdf::cell(55,8,utf8_decode("Fecha"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Estado"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","C",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(45,8,utf8_decode($reg->nombre),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->idinventario),1,"","C",true);
            $pdf::cell(55,8,utf8_decode($reg->fecha),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->estado_venta),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->valor_total),1,"","C",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}
