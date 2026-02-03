<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme_title' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'main_color'       => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'secondary_color'  => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'topic_color'      => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'solid_background' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'background_path'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'theme_title'      => 'nombre del tema',
            'main_color'       => 'color principal',
            'secondary_color'  => 'color secundario',
            'topic_color'      => 'color de la barra',
            'solid_background' => 'color de fondo sólido',
            'background_path'  => 'imagen de fondo',
        ];
    }

    public function messages(): array
    {
        return [

            'theme_title.required'      => 'El :attribute es obligatorio.',
            'theme_title.min'           => 'El :attribute debe tener al menos :min caracteres.',
            'theme_title.max'           => 'El :attribute es muy largo.',
            'theme_title.unique'        => 'Ya existe otro tema con este nombre.',


            'main_color.required'       => 'Selecciona un :attribute.',
            'main_color.regex'          => 'El :attribute no es un color hexadecimal válido.',
            'secondary_color.required'  => 'El :attribute es obligatorio.',
            'secondary_color.regex'     => 'El :attribute no tiene un formato válido.',
            'solid_background.required' => 'El :attribute es obligatorio.',
            'solid_background.regex'    => 'El :attribute no es un color válido.',
            'topic_color.regex'         => 'El formato del color de la barra es incorrecto.',


            'background_path.image'     => 'El archivo debe ser una imagen.',
            'background_path.mimes'     => 'Formatos permitidos: jpeg, png, jpg, svg.',
            'background_path.max'       => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}
