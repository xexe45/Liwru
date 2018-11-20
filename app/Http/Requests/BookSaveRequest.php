<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSaveRequest extends FormRequest
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
            'autor_id' => 'required|string',
            'isbn' => 'required|string|min:10|max:13',
            'title' => 'required|string|min:3|max:255',
            'category_id' => 'required|string',
            'condicion' => 'required|string',
            'imagen' => 'required|image',
            'descripcion' => 'required|string|min:3'
        ];
    }

    public function messages()
    {
        return [
            'autor_id.required' => 'El autor es requerido',
            'category_id.required' => 'La categoría es requerida',
            
        ];
    }
}
