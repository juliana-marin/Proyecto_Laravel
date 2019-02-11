<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class VentaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'idcliente'=>'required',
           'idinventario'=>'required',
           'fecha'=>'required',
           'valor_total'=>'required',
           'estado_venta'=>'required|max:45',
           'idproducto'=>'required',
           'cantidad'=>'required',
           'precio'=>'required',
           'impuesto'=>'required',
           'descripcion'=>'max:100',
           'descuento'=>'required',
          
        ];
    }
}
