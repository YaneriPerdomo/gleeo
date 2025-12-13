<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAdminRequest extends FormRequest
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
            'user_name' => ['required', 'min:8', 'max:12'],
            'email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}+$/'],

        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'El :attribute es obligatorio',
            'user_name.max' => 'El :attribute no debe exceder los :max caracteres',
            'user_name.min' => 'El :attribute  debe tener minimo :min caracteres',
            'email.required' => 'El :attribute es obligatorio',
            'email.regex' => 'El :attribute no cumple con el formato habitual que tiene',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'nombre de usuario',
            'email' => 'correo electronico',

        ];
    }
}
