<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|min:3',
            'email' =>  'required|email' 
        ];
    }

    public function messages(){
        return [
            'nom.required' => 'nom requis',
            'nom.min' => 'valeur minimum de nom 3 caracteres',
            'email.required' => 'email requis',
            'email.email' => 'email non valide',
        ];
    }
}
