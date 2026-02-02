<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepresentativeStoreRequest extends FormRequest
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
            'user' => ['required', 'string', 'min:4', 'max:20', 'unique:users,user'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role_identification' => ['required', 'in:Profesional,Representante'],

            // El centro educativo es requerido SOLO si el rol es Profesional
            'educational_center' => [
                'nullable',
                'required_if:role_identification,Profesional',
                'string',
                'max:150'
            ],

            'gender_id' => ['required', 'exists:genders'], // Asegúrate que la tabla exista
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'country_name' => ['nullable', 'string'],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'user.required' => 'El nombre de :attribute es obligatorio.',
            'user.unique' => 'Este nombre de :attribute ya está registrado.',
            'user.min' => 'El :attribute debe tener un límite mínimo de :min caracteres',
            'user.max' => 'El :attribute no debe exceder los :max caracteres',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa una dirección de correo válida.',
            'email.unique' => 'Este correo ya está en uso.',
            'role_identification.required' => 'Debes seleccionar un rol (Profesional o Representante).',
            'educational_center.required_if' => 'El Centro Educativo es obligatorio para profesionales.',
            'gender_id.required' => 'La selección de género es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password_confirmation' => 'La :attribute es obligatoria.'
        ];
    }

    /**
     * Atributos personalizados.
     */
    public function attributes(): array
    {
        return [
            'user' => 'usuario',
            'email' => 'correo electrónico',
            'role_identification' => 'identificación de rol',
            'educational_center' => 'centro educativo',
            'gender_id' => 'género',
            'password' => 'contraseña',
            'password_confirmation' => 'contraseña de confirmacion'
        ];
    }
}
