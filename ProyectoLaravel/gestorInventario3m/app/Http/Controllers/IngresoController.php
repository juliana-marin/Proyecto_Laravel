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

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
     public function __construct()
    {

    }
    public function index(Request $request)
    {
    	if ($request){
    		$query=trim($request->get('searchText'));
    		$ingresos=DB::table('ingreso as i')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha','i.comprobante','i.num_comprobante',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('idingreso','asc')
    		->groupBy('i.idingreso','i.fecha','i.comprobante','i.num_comprobante')
    		->paginate(10);
    		return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	$productos=DB::table('producto as pro')
    		->select(DB::raw('CONCAT(pro.nombre," ",pro.marca) AS producto'),'pro.idproducto')
    		->get();
        return view("compras.ingreso.create",["productos"=>$productos]);
    }

     public function store (IngresoaFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
    		$ingreso=new Ingreso;
       		$ingreso->idinventario=$request->get('idinventario');
       		$ingreso->comprobante=$request->get('comprobante');
       		$ingreso->num_comprobante=$request->get('num_comprobante');
       		$mytime = Carbon::now('America/Bogota');
       		$ingreso->fecha=$mytime->toDateTimeString();
       		$ingreso->save();

       		$idproducto = $request->get('idproducto');
       		$cantidad = $request->get('cantidad');
       		$precio_compra = $request->get('precio_compra');
       		$precio_venta = $request->get('precio_venta');

       		$cont = 0;

       		while ($cont < cont($idproducto)) {
       			$detalle=new DetalleIngreso();
       			$detalle->idingreso= $ingreso->idingreso;
       			$detalle->idproducto= $idproducto[$cont];
       			$detalle->cantidad= $cantidad[$cont];
       			$detalle->precio_compra= $precio_compra[$cont];
       			$detalle->precio_venta= $precio_venta[$cont];
       			$detalle->save();
       			$cont=$cont+1;
       		}

    		DB::comit();
    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}
        return Redirect::to('compras/ingreso');

    }


     public function show($id)
    {
    	$ingreso=DB::table('ingreso as i')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha','i.comprobante','i.num_comprobante',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.idingreso','=',$id)
    		->first();

    	$detalles=DB::table('detalle_ingreso as d')
    	->join('producto as pro','d.idproducto','=','pro.idproducto')
    		->select('pro.nombre as producto','d.cantidad','d.precio_compra','d.precio_venta')
    		->where('d.idingreo','=',$id)
    		->get();

        return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

     public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->delete($id);
        return Redirect::to('compras/ingreso');
    }

}
