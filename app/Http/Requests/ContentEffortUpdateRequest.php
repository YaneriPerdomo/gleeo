<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentEffortUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        // Cambiar a true para permitir el acceso
        return true;
    }

    /**
     * Reglas de validación aplicadas al formulario.
     */
    public function rules(): array
    {
        return [
            'refuerzo_limit' => [
                'required',
                'numeric',
                'min:1',
                'max:20'
            ],
            'pattern_status' => [
                'required',
                'in:activo,inactivo'
            ],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'refuerzo_limit.required' => 'El límite de fallos es obligatorio.',
            'refuerzo_limit.numeric'  => 'El límite de fallos debe ser un número.',
            'refuerzo_limit.min'      => 'El límite debe ser al menos 1.',
            'pattern_status.required' => 'Debe seleccionar un estado para el patrón.',
            'pattern_status.in'       => 'El estado seleccionado no es válido.',
        ];
    }

    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'refuerzo_limit' => 'límite de fallos para refuerzo',
            'pattern_status' => 'estado del patrón',
        ];
    }
}
