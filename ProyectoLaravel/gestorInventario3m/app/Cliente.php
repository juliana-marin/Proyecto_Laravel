<?php

namespace gestorInventario3m;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
      protected $table='cliente';

    protected $primaryKey='idCliente';

    public $timestamps=false;


    protected $fillable =[
    	'nombre',
    	'fecha_nacimiento',
    	'telefono',
    	'email',
    	'cedula'
    ];

    protected $guarded =[

    ];

}
