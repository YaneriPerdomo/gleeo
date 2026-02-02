<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInformationUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }


    public function rules(): array
    {
        return [
            'subject'     => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }


    public function messages(): array
    {
        return [

            'subject.required'     => 'El nombre de la materia es obligatorio.',
            'subject.string'       => 'La materia debe ser un texto válido.',
            'subject.min'          => 'El nombre de la materia es muy corto (mínimo 3 caracteres).',
            'subject.max'          => 'El nombre de la materia no puede exceder los 150 caracteres.',

            'description.required' => 'La descripción instructiva es obligatoria.',
            'description.string'   => 'La descripción debe ser un texto válido.',
            'description.min'      => 'La descripción debe ser más detallada para orientar al niño (mínimo 10 caracteres).',
            'description.max'      => 'La descripción es demasiado larga (máximo 1000 caracteres).',
        ];
    }


    public function attributes(): array
    {
        return [
            'subject'     => 'materia/asignatura',
            'description' => 'descripción',
        ];
    }
}
