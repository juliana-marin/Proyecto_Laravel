<?php

namespace gestorInventario3m\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Session;
use Redirect;
use gestorInventario3m\Http\Requests;

class CorreoController extends Controller
{
   public function __construct()
    {
     $this->middleware('auth');
    }

    public function index()
    {
       return view('correo.correo.contacto');
    }

    public function store(Request $request){
    	Mail::send('correo.correo.reports', $request->all(), function($msj){
    		$msj->subject('Cafe lounge 3 Marias');
    		$msj->to('juliana.marin04@gmail.com');
    	});
    	return view('correo.correo.contacto');
    }

  
}
