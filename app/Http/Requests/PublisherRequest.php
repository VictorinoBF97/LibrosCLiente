<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
            'name'      => 'required|min:5',
            'email'     => 'required|email',
            'url'       => 'required',
            'address'   => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     =>  'El :attribute es requerido',
            'name.min'          =>  'El :attribute debe tener al menos 3 caracteres',
            'email.required'    =>  'El :attribute es requerido',
            'email.email'       =>  'El :attribute no es válido',
            'url.required'      =>  'El :attribute es requerido',
            'address.required'  =>  'El :attribute es requerido',
            'address.min'       =>  'El :attribute debe tener al menos 10 caracteres'
        ];
    }
}
