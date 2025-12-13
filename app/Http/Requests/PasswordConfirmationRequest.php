<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordConfirmationRequest extends FormRequest
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
        $rules = [
            'password' => ['required', 'min:8', 'max:12', 'confirmed'],
        ];

        if ($this->input('password') != '') {
            $rules['password_confirmation'] = ['required'];

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'password.required' => 'La :attribute es obligatoria',
            'password.max' => 'La :attribute no debe exceder los :max caracteres',
            'password.min' => 'La :attribute  debe tener minimo :min caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide con la contraseña',
            'password_confirmation.required' => 'El campo de :attribute es obligatoria',
        ];


    }

    public function attributes()
    {
        return [
            'password' => 'contraseña',
            'password_confirmation' => 'confirmar contraseña',
        ];
    }
}
