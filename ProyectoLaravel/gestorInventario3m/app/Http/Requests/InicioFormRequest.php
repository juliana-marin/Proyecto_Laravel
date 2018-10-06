<?php

namespace gestorInventario3m\Http\Requests;

use gestorInventario3m\Http\Requests\Request;

class InicioFormRequest extends Request
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
           'imagen'=>'mimes:jpeg,bmp,png'
        ];
    }
}
