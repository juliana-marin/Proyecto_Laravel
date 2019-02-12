<?php

namespace gestorInventario3m\Http\Controllers;

use gestorInventario3m\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Funciona correctamente, compras por mes
        $comprasmes=DB::select('SELECT monthname(i.fecha) as mes, sum(di.cantidad*di.precio_compra) as totalmes from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where i.estado="Aceptado" group by monthname(i.fecha) order by month(i.fecha) desc limit 12');
        //Funciona correctamenta, ventas por mes
        $ventasmes=DB::select('SELECT monthname(v.fecha) as mes, sum(v.valor_total) as totalmes from venta v where v.estado_venta="Aceptado" group by monthname(v.fecha) order by month(v.fecha) desc limit 12');
        //Funciona correctamente
        $ventasdia=DB::select('SELECT DATE(v.fecha) as dia, sum(v.valor_total) as totaldia from venta v where v.estado_venta="Aceptado" group by v.fecha order by day(v.fecha) desc limit 15');
        //Funciona correctamente
        $productosvendidos=DB::select('SELECT p.nombre as producto,sum(dv.cantidad) as cantidad from producto p inner join detalle_venta dv on p.idproducto=dv.idproducto inner join venta v on dv.idventa=v.idVenta where v.estado_venta="Aceptado" and year(v.fecha)=year(curdate()) group by p.nombre order by sum(dv.cantidad) desc limit 10');
        //No arroja ningun resultado
        $totales=DB::select('SELECT (select ifnull(sum(di.cantidad*di.precio_compra),0) from ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso where DATE(i.fecha)=curdate() and i.estado="Aceptado") as totalingreso, (select ifnull(sum(v.valor_total),0) from venta v where DATE(v.fecha)=curdate() and v.estado_venta="Aceptado") as totalventa');

            return view('home',["comprasmes"=>$comprasmes,"ventasmes"=>$ventasmes,"ventasdia"=>$ventasdia,"productosvendidos"=>$productosvendidos,"totales"=>$totales]);
    }
}

