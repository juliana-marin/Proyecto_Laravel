<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use gestorInventario3m\Http\Requests;
use gestorInventario3m\Inicio;
use Illuminate\Support\Facades\Redirect;
use gestorInventario3m\Http\Requests\InicioFormRequest;

use DB;

class InicioController extends Controller
{
	public function __construct()
    {
     $this->middleware('auth');
    }


     public function index()
    {
        
            return view('inicio.inicio.show');
    }
}
