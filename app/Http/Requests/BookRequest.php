<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'         => 'required|min:3',
            'publisher'      => 'required|exists:publishers,id',
            'author'        => ['required','exists:authors,id'],
            'description'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=> 'El :attribute es requerido.',
            'title.min' => 'El :attribute debe tener al menos 3 caracteres',
            'publisher.required' => 'La :attribute es requerida',
            'publisher.exists' => 'Debe introducir una :attribute válida.',
            'author.required'=> 'El :attribute es requerido.',
            'author.exists'    => 'Debe introducir un :attribute ya registrado en la BD.',
            'description.required'=> 'La :attribute es requerida.',
        ];
    }

    public function attributes()
    {
        return [
            'title'     => 'título del libro',
            'publisher' => 'editorial del libro',
            'author'    => 'autor del libro',
            'description' => 'descripción del libro'
        ];
    }
}
