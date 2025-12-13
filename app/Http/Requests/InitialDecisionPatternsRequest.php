<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InitialDecisionPatternsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'refuerzo_limit' => ['required', 'regex:/^[0-9]+$/u', 'max:4'],
            'pattern_status' => ['required', Rule::in(['activo', 'inactivo'])],
        ];
    }
    public function messages(): array
    {
        return [
            'refuerzo_limit.required' => 'El :attribute es obligatorio.',
            'refuerzo_limit.regex' => 'El :attribute debe ser un número entero positivo (0 o superior).',
            'refuerzo_limit.max' => 'El :attribute no debe exceder los :max dígitos.',
            'pattern_status.required' => 'El estado de activación es obligatorio.',
            'pattern_status.in' => 'El estado de activación debe ser "Activo" o "Inactivo".',
        ];
    }
    public function attributes(): array
    {
        return [
            'refuerzo_limit' => 'límite de fallos para refuerzo',
            'pattern_status' => 'estado de activación del patrón',
        ];
    }
}
