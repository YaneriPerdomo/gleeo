<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildStoreRequest extends FormRequest
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
            'names'          => ['required', 'string', 'max:100'],
            'last_names'     => ['required', 'string', 'max:100'],
            'date_of_birth'  => ['required', 'date', 'before:today'],
            'gender_id'      => ['required', 'exists:genders,gender_id'],

            'avatar_id'      => ['required', 'exists:avatars,avatar_id'],
            'theme_id'       => ['required', 'exists:themes,theme_id'],
            'assigned_level' => ['required', 'exists:levels,level_id'],
            'reading_mode'   => ['nullable', 'boolean'],

            'username'       => ['required', 'string', 'alpha_num', 'min:4', 'max:20', 'unique:users, user'],
            'password'       => ['required', 'string', 'min:6', 'max:50', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            // Nombres
            'names.required'         => 'El nombre es obligatorio.',
            'names.string'           => 'El nombre no debe contener números.',
            'names.max'              => 'El nombre no puede exceder los 100 caracteres.',

            // Apellidos
            'last_names.required'    => 'Los apellidos son obligatorios.',
            'last_names.string'      => 'Los apellidos no deben contener números.',
            'last_names.max'         => 'Los apellidos no pueden exceder los 100 caracteres.',

            // Fecha y Género
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.before'   => 'La fecha de nacimiento no puede ser futura.',
            'gender_id.required'     => 'Debe seleccionar un género.',

            // Personalización
            'avatar_id.required'     => 'Por favor, elige un avatar.',
            'theme_id.required'      => 'Debes seleccionar un tema visual.',
            'assigned_level.required'  => 'Por favor, elige un nivel inicial.',
            'assigned_level.exists'  => 'El nivel seleccionado no es válido.',

            // Usuario
            'username.required'      => 'El nombre de usuario es obligatorio.',
            'username.unique'        => 'Este nombre de usuario ya está en uso.',
            'username.alpha_num'     => 'El usuario solo puede contener letras y números.',
            'username.min'           => 'El usuario debe tener al menos 4 caracteres.',
            'username.max'           => 'El usuario no puede exceder los 20 caracteres.',

            // Contraseña
            'password.required'      => 'La contraseña es obligatoria.',
            'password.confirmed'     => 'Las contraseñas no coinciden.',
            'password.min'           => 'La contraseña debe tener al menos 6 caracteres.',
            'password.max'           => 'La contraseña es demasiado larga (máximo 50 caracteres).',
        ];
    }
    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'names'          => 'nombres',
            'last_names'     => 'apellidos',
            'date_of_birth'  => 'fecha de nacimiento',
            'gender_id'      => 'género',
            'avatar_id'      => 'avatar',
            'theme_id'       => 'tema',
            'username'       => 'nombre de usuario',
            'password'       => 'contraseña',
            'assigned_level' => 'nivel inicial',
        ];
    }
}
