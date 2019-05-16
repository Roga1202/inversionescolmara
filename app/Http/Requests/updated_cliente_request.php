<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updated_cliente_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nit' => 'unique:cliente,CL_NIT,'.request()->id.',CL_ID',
            'direccion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nit.unique' => 'El NIT ya se encuentra registrado',
            'direccion.required' => 'La direccion es obligatoria',
        ];
    }
}
