<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table='inventario';

    protected $primaryKey='idinventario';

    public $timestamps=false;


    protected $fillable =[
    	'idproducto',
    	'cant_producto_ingreso',
    	'cant_producto_vendido',
    	'cant_producto_restante',
    	'precio'
    ];

    protected $guarded =[

    ];
}
