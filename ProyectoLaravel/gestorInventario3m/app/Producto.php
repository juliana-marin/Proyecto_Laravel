<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
     protected $table='producto';

    protected $primaryKey='idproducto';

    public $timestamps=false;

    protected $fillable =[
        'idcategoria',
    	'nombre',
    	'marca',
    	'precio',
    	'descripcion',
    	'imagen'
    ];

    protected $guarded =[

    ];
}
