<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use gestorInventario3m\Http\Requests;
use gestorInventario3m\Producto;

class CarritoController extends Controller
{
	public function __construct()
	{
		if (!\Session::has('cart')) \Session::put('cart',array()); 
	}


    //Mostrar el carrito
    public function show(){
    	$cart = \Session::get('cart');
        return view('carrito.cart',compact('cart'));

    }

    //Agregar productos al carrito
     public function add(Producto $producto){
     	
    	$cart = \Session::get('cart');
        $producto->cantidad =1;
        $cart[$producto->idproducto] = $producto;
    	\Session::put('cart', $cart);
    	
    	return redirect()->route('cart-show')->with('message', 'Success!');


    }

    //Eliminar productos del carrito
     public function delete(Producto $producto){
        $cart = \Session::get('cart');
        unset($cart[$producto->idproducto]);
        \Session::put('cart', $cart);

        return redirect()->route('cart-show');
    }

    //Actualizar el carrito
     public function update(Producto $producto, $cantidad){
        $cart = \Session::get('cart');
        $cart[$producto->idproducto->cantidad] = $cantidad;
        \Session::put('cart', $cart);

        return redirect()->route('cart-show');
    	
    }

    //Limpiar el carrito
     public function trash(){
        \Session::forget('cart');
        return redirect()->route('cart-show');
    	
    }

    //Valor total por productos del carrito
     public function total(){
    	
    }
}
