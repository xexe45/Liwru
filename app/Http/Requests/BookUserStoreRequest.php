<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUserStoreRequest extends FormRequest
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
            'id_encontrado' => 'required|numeric',
            'condicion_encontrado' => 'required|string',
            'descripcion_encontrado' => 'required|string|min:3'
        ];
    }

    public function messages()
    {
        return [
            'id_encontrado.required' => 'El libro es requerido',
            'condicion_encontrado.required' => 'La condición del libro es requerida',
            'descripcion_encontrado.required' => 'La descripción es requerida',
            
        ];
    }
}
