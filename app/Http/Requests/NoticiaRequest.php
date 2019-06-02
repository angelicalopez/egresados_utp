<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'imagenes.*.file' => 'No es un archivo',
            'archivos.*.file' => 'No es un archivo',
            'imagenes.*.image' => 'Se espera un imagen',
            'archivos.*.mimes' => 'Se espera un archivo .pdf o .docx',
            'videos.*.url' => 'El valor insertado no es una url valida'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                $rules = [
                    'nombre' => 'required|min:4|max:100',
                    'descripcion' => 'required',
                    'archivos' => 'nullable|array',
                    'archivos.*' => 'file|mimes:pdf,docx',
                    'imagenes' => 'nullable|array',
                    'imagenes.*' => 'image',
                    'videos' => 'nullable|array',
                    'videos.*' => 'nullable|url'
                ];
            break;
            case 'PUT':
                $rules = [];
            break;
        }
        return $rules;
    }
}
