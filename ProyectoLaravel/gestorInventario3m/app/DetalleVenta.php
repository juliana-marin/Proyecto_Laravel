<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table='detalle_venta';

    protected $primaryKey='iddetalle_factura';

    public $timestamps=false;


    protected $fillable =[
    	'idproducto',
    	'idventa',
    	'cantidad',
    	'precio',
    	'impuesto',
    	'descripcion',
    	'descuento'
    ];

    protected $guarded =[

    ];
}
