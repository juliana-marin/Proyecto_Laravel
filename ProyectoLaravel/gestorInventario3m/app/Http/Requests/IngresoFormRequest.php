<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class IngresoFormRequest extends Request
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
           'idinventario'=>'required',
           'comprobante'=>'required|max:45',
           'num_comprobante'=>'required|max:45',
           'fecha'=>'required',
           'idproducto'=>'required',
           'cantidad'=>'required',
           'precio_compra'=>'required',
           'precio_venta'=>'required'
        ];
    }
}
