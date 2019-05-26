<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'apellidos' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users',
            'dni' => 'required|min:8|max:50|unique:administradores',
            'direccion' => 'min:8|max:50',
            'telefono' => 'min:8|max:50',
            'pais_id' => 'integer|exists:paises,id',
            'password' => 'required|min:6|max:20'
        ];
    }
}
