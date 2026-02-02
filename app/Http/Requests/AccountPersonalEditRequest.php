<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountPersonalEditRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'user_name' => ['required' , 'min:4', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'user_name.required' => 'El nombre de :attribute es obligatorio.',
            'user_name.unique' => 'Este nombre de :attribute ya está registrado.',
            'user_name.min' => 'El :attribute debe tener un límite mínimo de :min caracteres',
            'user_name.max' => 'El :attribute no debe exceder los :max caracteres',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa una dirección de correo válida.',
            'email.unique' => 'Este correo ya está en uso.',

        ];
    }

    /**
     * Atributos personalizados.
     */
    public function attributes(): array
    {
        return [
            'user_name' => 'usuario',
            'email' => 'correo electrónico',
        ];
    }
}
