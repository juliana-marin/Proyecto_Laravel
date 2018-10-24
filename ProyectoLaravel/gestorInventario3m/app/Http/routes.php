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

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/producto','ProductoController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('inventarioProducto/inventario','InventarioController');
Route::resource('ventas/venta','VentaController');
Route::resource('inicio/inicio','InicioController');
Route::resource('correo/correo','CorreoController');
Route::resource('menuProductos/menu','MenuController');
Route::resource('seguridad/usuario','UsuarioController');

Route::get('form_enviar_correo', 'CorreoController@crear');
Route::post('enviar_correo', 'CorreoController@enviar');
Route::post('cargar_archivo_correo', 'CorreoController@store');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');

