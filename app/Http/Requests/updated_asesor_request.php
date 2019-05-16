<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updated_asesor_request extends FormRequest
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
            'cedula' => 'numeric | unique:asesor,AS_cedula,'.request()->id.',AS_ID',
            'tipo' => 'alpha_num',
            'telefono' => 'numeric | unique:asesor,AS_telefono,'.request()->id.',AS_ID',
            'telefono_emergencia' => 'numeric',
            'correo' => 'email | unique:asesor,AS_correo,'.request()->id.',AS_ID',
            'imei' => 'numeric | unique:asesor,AS_IMEI,'.request()->id.',AS_ID',
            'alias' => 'unique:asesor,AS_alias,'.request()->id.',AS_ID',
        ];
    }

    public function messages()
    {
        return [
            'cedula.numeric' => 'La cedula debe poseer solo numeros',
            'cedula.unique' => 'La cedula se encuentra ya se encuentra registrada',
            'tipo.alpha_num' => 'El tipo solo puede ser numeros o letras',
            'telefono.numeric' => 'El telefono solo debe poseer numeros',
            'telefono.unique' => 'El telefono ya se encuentra registrado',
            'telefono_emergencia.numeric' => 'El telefono de emergencia solo debe poseer numeros',
            'correo.email' => 'El correo es incorrecto',
            'correo.unique' => 'El correo ya se encuentra registrado',
            'imei.numeric' => 'El IMEI solo deben ser numeros',
            'imei.unique' => 'El IMEI ya se encuentra registado',
            'alias.unique' => 'El alias ya esta registrado',
        ];
    }
}
