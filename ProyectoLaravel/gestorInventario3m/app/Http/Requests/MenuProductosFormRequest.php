<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class MenuProductosFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'marca'=>'required|max:45',
            'precio'=>'required|max:45',
            'descripcion'=>'max:150',
            'imagen'=>'mimes:jpeg,bmp,png'
            'cantidad'=>'required',
        ];
    }
}
