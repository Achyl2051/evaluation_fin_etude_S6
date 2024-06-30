<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|min : 3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min : 3'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'nom requis',
            'name.min' => 'nom minimum 3',
            'email.required' => 'email  requis',
            'email.unique' => 'email  deja lie a un compte',
            'email.email' => 'email  non valide',
            'password.required' => 'password requis',
            'password.min' => 'password  minimum 3',

        ];
    }
}
