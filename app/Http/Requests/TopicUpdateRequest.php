<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicUpdateRequest extends FormRequest
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
            'topic_title' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }

    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'topic_title' => 'tema',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'topic_title.required' => 'El nombre del :attribute es obligatorio.',
            'topic_title.unique'   => 'Este :attribute ya se encuentra registrado.',
            'topic_title.min'      => 'El :attribute debe tener al menos :min caracteres.',
            'topic_title.max'      => 'El :attribute no debe exceder los :max caracteres.',
            'topic_title.string'   => 'El :attribute debe ser un texto válido.',
        ];
    }
}
