<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInformationUpdateRequest extends FormRequest
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

            'role_identification' => ['required', 'in:Profesional,Representante'],


            'educational_center' => [
                'nullable',
                'required_if:role_identification,Profesional',

                'max:150'
            ],

            'gender_id' => ['required', 'exists:genders'],

        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [

            'role_identification.required' => 'Debes seleccionar un rol (Profesional o Representante).',
            'educational_center.required_if' => 'El Centro Educativo es obligatorio para profesionales.',
            'gender_id.required' => 'La selección de género es obligatoria.',

        ];
    }

    /**
     * Atributos personalizados.
     */
    public function attributes(): array
    {
        return [

            'role_identification' => 'identificación de rol',
            'educational_center' => 'centro educativo',
            'gender_id' => 'género',

        ];
    }
}
