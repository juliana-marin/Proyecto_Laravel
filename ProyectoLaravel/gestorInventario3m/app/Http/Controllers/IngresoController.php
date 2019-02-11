<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\IngresoFormRequest;
use gestorInventario3m\Ingreso;
use gestorInventario3m\DetalleIngreso;
use DB;

use Fpdf;


use Carbon\Carbon;//Control de fechas
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
     public function __construct()
    {
      $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request){
    		$query=trim($request->get('searchText'));
    		$ingresos=DB::table('ingreso as i')
        ->join('inventario as inv','i.idinventario','=','inv.idinventario')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.idingreso','LIKE','%'.$query.'%')
    		->orderBy('idingreso','asc')
    		->groupBy('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado')
    		->paginate(10);
    		return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    	}
    }
    public function create()
    {
      $inventarios=DB::table('inventario')->get();
    	$productos=DB::table('producto as pro')
    		->select(DB::raw('CONCAT(pro.nombre," ",pro.marca) AS producto'),'pro.idproducto')
    		->get();
        return view('compras.ingreso.create',["inventarios"=>$inventarios,"productos"=>$productos]);
    }

     public function store (IngresoFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
    		$ingreso=new Ingreso;
       	$ingreso->idinventario=$request->get('idinventario');
       	$ingreso->comprobante=$request->get('comprobante');
       	$ingreso->num_comprobante=$request->get('num_comprobante');
       	
        $mytime=Carbon::now('America/Bogota');
       	$ingreso->fecha=$mytime->toDateTimeString();
        $ingreso->estado=$request->get('estado');
       	$ingreso->save();

       	$idproducto=$request->get('idproducto');
       	$cantidad=$request->get('cantidad');
       	$precio_compra=$request->get('precio_compra');
       	$precion_venta=$request->get('precion_venta');

       	$cont = 0;

       		while ($cont < count($idproducto)) {
       			$detalle = new DetalleIngreso();
                $detalle->idproducto=$idproducto[$cont];
       			$detalle->idingreso=$ingreso->idingreso;
       			$detalle->cantidad=$cantidad[$cont];
       			$detalle->precio_compra=$precio_compra[$cont];
       			$detalle->precion_venta=$precion_venta[$cont];
       			$detalle->save();
       			$cont=$cont+1;
       		}

    		DB::commit();

    	}catch(Exception $e)
    	{
    		DB::rollback();
    	}
        return Redirect::to('compras/ingreso');

    }


     public function show($id)
    {
    	$ingreso=DB::table('ingreso as i')
        ->join('inventario as inv','i.idinventario','=','inv.idinventario')
        ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
        ->select('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.idingreso','=',$id)
    		->first();

    	$detalles=DB::table('detalle_ingreso as d')
    	   ->join('producto as p','d.idproducto','=','p.idproducto')
    		 ->select('p.nombre as producto','d.cantidad','d.precio_compra','d.precion_venta')
    		 ->where('d.idingreso','=',$id)
    		 ->get();

      return view('compras.ingreso.show',["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

     public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->Estado='Anulado';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }

    public function reportec($id){

      //obtenemos los datos
        $ingresos=DB::table('ingreso as i')
            ->join('inventario as inv','i.idinventario','=','inv.idinventario')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.idingreso','=',$id)
            ->first();


        $detalles=DB::table('detalle_ingreso as d')
            ->join('producto as p','d.idproducto','=','p.idproducto')
            ->select('p.nombre as producto','d.cantidad','d.precio_compra','d.precion_venta')
            ->where('d.iddetalle_ingreso','=',$id)
            ->get();

        $pdf = new Fpdf();
        $pdf::AddPage();
        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(30,20);
        $pdf::Cell(0,0,utf8_decode($ingresos->comprobante));

        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(90,20);
        $pdf::Cell(0,0,utf8_decode($ingresos->num_comprobante));

        $pdf::SetFont('Arial','B',10);
        $pdf::SetXY(30,30);
        $pdf::Cell(0,0,utf8_decode($ingresos->estado));
        $pdf::SetXY(30,40);
        $pdf::Cell(0,0,utf8_decode($ingresos->idinventario));
       
        
        //***Parte de la derecha
        $pdf::SetXY(30,55);
        $pdf::Cell(0,0,utf8_decode($ingresos->idingreso));
        $pdf::SetXY(70,55);
        $pdf::Cell(0,0,substr($ingresos->fecha,0,10));
        $total=0;
         
        //Mostramos los detalles
        $y=79;
        foreach($detalles as $det){
            $pdf::SetXY(30,$y);
            $pdf::MultiCell(25,0,utf8_decode($det->producto));

            $pdf::SetXY(100,$y);
            $pdf::MultiCell(25,0,($det->cantidad));

            $pdf::SetXY(162,$y);
            $pdf::MultiCell(25,0,($det->precio_compra));

            $pdf::SetXY(187,$y);
            $pdf::MultiCell(25,0,($det->precion_venta));

            $total=$total+($det->precio_compra*$det->cantidad);
            $y=$y+7;
        }

        $pdf::SetXY(187,153);
        $pdf::MultiCell(20,0,"".sprintf("%0.2F", $ingresos->total));

        $pdf::Output();
        exit;
    }
    public function reporte(){
         //Obtenemos los registros
        $registros=DB::table('ingreso as i')
            ->join('inventario as inv','i.idinventario','=','inv.idinventario')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->orderBy('idingreso','asc')
            ->groupBy('i.idingreso','inv.idinventario','i.comprobante','i.num_comprobante','i.fecha','i.estado')
            ->get();

         //Ponemos la hoja Horizontal (L)
         $pdf = new Fpdf('L','mm','A4');
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Compras"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(45,8,utf8_decode("Fecha"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Inventario"),1,"","C",true);
         $pdf::cell(45,8,utf8_decode("Comprobante"),1,"","C",true);
         $pdf::cell(55,8,utf8_decode("N° comprobante"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","R",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(45,8,utf8_decode($reg->fecha),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->idinventario),1,"","C",true);
            $pdf::cell(45,8,utf8_decode($reg->comprobante),1,"","C",true);
            $pdf::cell(55,8,utf8_decode($reg->num_comprobante),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->total),1,"","R",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}
