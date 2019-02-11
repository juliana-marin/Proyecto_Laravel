<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
     protected $table='ingreso';

    protected $primaryKey='idingreso';

    public $timestamps=false;


    protected $fillable =[
    	'idinventario',
    	'comprobante',
    	'num_comprobante',
    	'fecha',
        'estado'
    ];

    protected $guarded =[

    ];
}
