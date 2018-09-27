<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\ProductoFormRequest;
use gestorInventario3m\Producto;
use DB;
class ProductoController extends Controller
{
     public function __construct()
    {
      
    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $productos=DB::table('Producto as p')
            ->join('categoria as cat','p.idcategoria','=','cat.idcategoria')
            ->select('p.idproducto','cat.nombre as categoria','p.nombre','p.marca','p.precio','p.descripcion','p.imagen')
            ->where('cat.nombre','LIKE','%'.$query.'%')
            ->orwhere('p.idproducto','LIKE','%'.$query.'%')
            ->orderBy('idproducto','asc')
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
        $Producto=new Producto;
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
        $producto->categoria=$request->get('idcategoria');
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




}
