<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlertThresholdsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'alert_activations_threshold_basic' => ['required', 'regex:/^[0-9]+$/u', 'max:4'],
            'alert_activations_threshold_intermediate' => ['required', 'regex:/^[0-9]+$/u', 'max:4'],
            'alert_activations_threshold_advanced' => ['required', 'regex:/^[0-9]+$/u', 'max:4'],

            'time_window_basic' => ['required', Rule::in(['24 Horas', '7 Dias', '30 Dias'])],
            'time_window_intermediate' => ['required', Rule::in(['24 Horas', '7 Dias', '30 Dias'])],
            'time_window_advanced' => ['required', Rule::in(['24 Horas', '7 Dias', '30 Dias'])],
        ];
    }


    public function messages(): array
    {
        return [
            'alert_activations_threshold_basic.required' => 'Las :attribute es obligatorio.',
            'alert_activations_threshold_basic.regex' => 'Las :attribute debe ser un número entero (0 o superior).',
            'alert_activations_threshold_basic.max' => 'Las :attribute no debe exceder los :max dígitos.',

            'alert_activations_threshold_intermediate.required' => 'Las :attribute es obligatorio.',
            'alert_activations_threshold_intermediate.regex' => 'Las :attribute debe ser un número entero (0 o superior).',
            'alert_activations_threshold_intermediate.max' => 'Las :attribute no debe exceder los :max dígitos.',

            'alert_activations_threshold_advanced.required' => 'Las :attribute es obligatorio.',
            'alert_activations_threshold_advanced.regex' => 'Las :attribute debe ser un número entero (0 o superior).',
            'alert_activations_threshold_advanced.max' => 'Las :attribute no debe exceder los :max dígitos.',

            'time_window_basic.required' => 'Las :attribute es obligatoria.',
            'time_window_basic.in' => 'Las :attribute seleccionada no es válida.',

            'time_window_intermediate.required' => 'Las :attribute es obligatoria.',
            'time_window_intermediate.in' => 'Las :attribute seleccionada no es válida.',

            'time_window_advanced.required' => 'Las :attribute es obligatoria.',
            'time_window_advanced.in' => 'Las :attribute seleccionada no es válida.',
        ];
    }
    public function attributes(): array
    {
        return [
            'alert_activations_threshold_basic' => 'activaciones de ce para alerta (Básico)',
            'alert_activations_threshold_intermediate' => 'activaciones de ce para alerta (Intermedio)',
            'alert_activations_threshold_advanced' => 'activaciones de ce para alerta (Avanzado)',

            'time_window_basic' => 'ventana de tiempo (Básico)',
            'time_window_intermediate' => 'ventana de tiempo (Intermedio)',
            'time_window_advanced' => 'ventana de tiempo (Avanzado)',
        ];
    }
}
