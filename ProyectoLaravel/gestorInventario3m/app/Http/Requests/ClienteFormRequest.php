<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class ClienteFormRequest extends Request
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
            'nombre'=>'max:55',
            'fecha_nacimiento'=>'max:150',
            'telefono'=>'max:45',
            'email'=>'max:45',
            'cedula'=>'max:45'
        ];
    }
}
