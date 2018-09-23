<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class InventarioFormRequest extends Request
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
           'idproducto'=>'required',
           'cant_producto_ingreso'=>'required|max:45',
           'cant_producto_vendido'=>'required|max:45',
           'cant_producto_restante'=>'required|max:45',
           'precio'=>'required|numeric',
        ];
    }
}
