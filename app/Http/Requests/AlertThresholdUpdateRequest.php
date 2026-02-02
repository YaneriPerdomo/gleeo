<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertThresholdUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];


        foreach ($this->all() as $key => $value) {
            if (strpos($key, 'id_') === 0) {
                $index = str_replace('id_', '', $key);

                $rules["id_{$index}"] = ['required', 'exists:alert_configurations,alert_config_id'];
                $rules["max_errors_allowed_{$index}"] = ['required', 'numeric', 'min:1', 'max:50'];
                $rules["time_window_{$index}"] = ['required', 'in:24 Horas,7 Dias,30 Dias'];
                $rules["state_{$index}"] = ['required', 'in:activo,inactivo'];
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [

            'max_errors_allowed_*.required' => 'El umbral de errores es obligatorio.',
            'max_errors_allowed_*.numeric'  => 'El umbral debe ser un número.',
            'time_window_*.required'        => 'Debe seleccionar una ventana de tiempo.',
            'state_*.required'              => 'Debe seleccionar un estado.',
            'state_*.in'                    => 'El estado seleccionado no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [

            'max_errors_allowed_*' => 'umbral de errores',
            'time_window_*'        => 'ventana de tiempo',
            'state_*'              => 'estado del patrón',
        ];
    }
}
