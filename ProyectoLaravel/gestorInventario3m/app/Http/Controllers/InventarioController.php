<?php
namespace gestorInventario3m\Http\Controllers;
use Illuminate\Http\Request;
use gestorInventario3m\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests\InventarioFormRequest;
use gestorInventario3m\Inventario;
use DB;
class InventarioController extends Controller
{
     public function __construct()
    {
        
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
}
