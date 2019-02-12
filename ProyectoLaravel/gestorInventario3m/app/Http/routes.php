<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/acerca', function () {
    return view('acerca');
});
Route::bind('producto', function($idproducto){
	return gestorInventario3m\Producto::where('idproducto',$idproducto)->first();
});


Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/producto','ProductoController');
Route::resource('almacen/producto','ProductoController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('inventarioProducto/inventario','InventarioController');
Route::resource('ventas/venta','VentaController');
Route::resource('inicio/inicio','InicioController');
Route::resource('correo/correo','CorreoController');
Route::resource('menuProductos/menu','MenuController');
Route::resource('seguridad/usuario','UsuarioController');


Route::auth();

//Reportes
Route::get('reportecategorias', 'CategoriaController@reporte');
Route::get('reporteproductos', 'ProductoController@reporte');
Route::get('reporteclientes', 'ClienteController@reporte');
Route::get('reporteventas', 'VentaController@reporte');
Route::get('reporteventa/{id}', 'VentaController@reportec');
Route::get('reporteingresos', 'IngresoController@reporte'); 
Route::get('reporteingreso/{id}', 'IngresoController@reportec'); 
Route::get('reporteinventarios', 'InventarioController@reporte');


Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');


//Carrito de compras
Route::get('carrito/show', [
	'as'=>'cart-show',
	'uses'=>'CarritoController@show' 
]);

Route::get('carrito/add/{idproducto}', [
	'as'=>'cart-add',
	'uses'=>'CarritoController@add' 
]);

Route::get('carrito/delete/{producto}', [
	'as'=>'cart-delete',
	'uses'=>'CarritoController@delete' 
]);

Route::get('carrito/trash', [
	'as'=>'cart-trash',
	'uses'=>'CarritoController@trash'
 ]);
Route::get('carrito/update/{producto}/{cantidad?}', [
	'as'=>'cart-update',
	'uses'=>'CarritoController@update'
 ]);



