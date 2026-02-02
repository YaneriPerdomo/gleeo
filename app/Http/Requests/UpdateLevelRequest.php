<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
{
    /**
     * Determina si el usuario tiene permiso para esta acción.
     */
    public function authorize(): bool
    {
        return true; // Cambiar a auth()->check() si requiere login
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'level_title' => ['required', 'string', 'min:3', 'max:50', 'unique:levels,name'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'level_title' => 'nombre del nivel',
            'description' => 'descripción',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'level_title.required' => 'Es necesario que le asignes un :attribute.',
            'level_title.unique'   => 'Ya existe un nivel con ese nombre.',
            'description.max'      => 'La :attribute es muy larga (máximo 255 caracteres).',
        ];
    }
}
