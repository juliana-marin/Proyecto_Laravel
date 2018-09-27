<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     protected $table='venta';

    protected $primaryKey='idVenta';

    public $timestamps=false;


    protected $fillable =[
    	'idcliente',
    	'idinventario',
    	'fecha',
    	'valor_total',
    	'estado_venta'
    ];

    protected $guarded =[

    ];
}
