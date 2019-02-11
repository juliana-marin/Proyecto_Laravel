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
     $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$query=trim($request->get('searchText'));
    	$productos=DB::table('Producto as producto')->get();
       	return view('menuProductos.menu.index',["productos"=>$productos,"searchText"=>$query]);
    }

     public function show($id)
    {
    	return view("menuProductos.menu.index",["producto"=>Producto::findOrFail($id)]);
    	
    }
}
