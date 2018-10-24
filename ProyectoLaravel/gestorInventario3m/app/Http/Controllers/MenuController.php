<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;
use gestorInventario3m\MenuProductos;
use Illuminate\Support\Facades\Redirect;
use gestorInventario3m\Http\Requests\MenuProductosFormRequest;
use DB;


class MenuController extends Controller
{
    public function __construct()
    {
     
    }

    public function index()
    {
    	$productos=DB::table('producto')->get();
       return view('menuProductos.menu.index',["productos"=>$productos]);
    }

     public function show($id)
    {
    	return view("menuProductos.menu.show",["producto"=>Producto::findOrFail($id)]);
    	
    }
}
