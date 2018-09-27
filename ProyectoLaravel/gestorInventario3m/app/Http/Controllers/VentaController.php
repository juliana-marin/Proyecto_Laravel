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

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
 public function __construct()
    {
       
    }
    public function index(Request $request)
    {
    	if ($request){
    		$query=trim($request->get('searchText'));
    		$ventas=DB::table('venta as v')
            ->join('cliente as c','v.idcliente','=','c.idcliente')
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
    	try{
    		DB::beginTransaction();
    	$venta=new Venta;
       	$venta->idcliente=$request->get('idcliente');
       	$venta->idinventario=$request->get('idinventario');
       	$mytime = Carbon::now('America/Bogota');
       	$venta->fecha=$mytime->toDateTimeString();
       	$venta->valor_total=$request->get('valor_total');
       	$venta->estado_venta=$request->get('estado_venta');
       	$venta->save();

       	$idproducto = $request->get('idproducto');
       	$cantidad = $request->get('cantidad');
       	$precio = $request->get('precio');
       	$impuesto =$request->get('impuesto');
       	$descripcion = $request->get('descripcion');
       	$descuento = $request->get('descuento');

       	$cont = 0;

       		while ($cont < cont($idproducto)) {
       			$detalle = new DetalleVenta();
       			$detalle->idventa=$venta->idventa;
       			$detalle->idproducto=$idproducto[$cont];
       			$detalle->cantidad= $cantidad[$cont];
       			$detalle->precio=$precio[$cont];
       			$detalle->impuesto=$impuesto[$cont];
       			$detalle->descripcion=$descripcion[$cont];
       			$detalle->descuento=$descuento[$cont];
       			$detalle->save();
       			$cont=$cont+1;
       		}

    		DB::commit();
    	}catch(\Exception $e)
    	{
    		DB::rollback();
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

     public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado_venta='cancelado';
        $venta->update($id);
        return Redirect::to('ventas/venta');
    }

}
