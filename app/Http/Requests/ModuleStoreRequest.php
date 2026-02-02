<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleStoreRequest extends FormRequest
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
            'module_title' => ['required', 'string', 'min:3', 'max:50', 'unique:modules,title'],
        ];
    }

    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'module_title' => 'modulo',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'module_title.required' => 'El nombre del :attribute es obligatorio.',
            'module_title.unique'   => 'Este :attribute ya se encuentra registrado.',
            'module_title.min'      => 'El :attribute debe tener al menos :min caracteres.',
            'module_title.max'      => 'El :attribute no debe exceder los :max caracteres.',
            'module_title.string'   => 'El :attribute debe ser un texto válido.',
        ];
    }
}
