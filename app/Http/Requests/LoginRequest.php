<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'user' => ['required'],
            'password' => ['required',  'max:15'],
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'El :attribute es obligatorio',
            'password.required' => 'La :attribute es obligatoria',
             'password.max' => 'La :attribute no debe exceder los :max caracteres',

        ];
    }
    public function attributes()
    {
        return [
            'user' => 'nombre de usuario',
            'password' => 'contraseña',
        ];
    }
}
