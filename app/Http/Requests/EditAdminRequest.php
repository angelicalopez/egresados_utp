<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditAdminRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max:100',
            'apellidos' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'dni' => 'required|min:8|max:50|unique:administradores,dni,'.$this->admin_id,
            'direccion' => 'nullable|min:8|max:50',
            'telefono' => 'nullable|min:8|max:50',
            'pais_id' => 'integer|exists:paises,id',
            'password' => 'nullable|min:6|max:20',
            'id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:administradores,id',
            'estado' => 'required',Rule::in(['A', 'I'])
        ];
        return $rules;
    }
}
