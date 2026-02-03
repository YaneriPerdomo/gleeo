<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeStoreRequest extends FormRequest
{
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
            'name'      => ['required', 'string', 'min:3', 'max:100', 'unique:themes,name'],
            'main_color'       => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'secondary_color'  => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'topic_color'      => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'solid_background' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'background_path'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ];
    }

    /**
     * Nombres de atributos amigables.
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre del tema',
            'main_color'       => 'color principal',
            'secondary_color'  => 'color secundario',
            'topic_color'      => 'color de la barra',
            'solid_background' => 'color de fondo sólido',
            'background_path'  => 'imagen de fondo',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio.',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida.',
            'name.min'          => 'El :attribute es muy corto (mínimo :min caracteres).',
            'name.max'          => 'El :attribute no debe exceder los :max caracteres.',
            'name.unique'       => 'Este :attribute ya se encuentra registrado.',

            // Mensajes para los Colores (Regex)
            'main_color.required'      => 'El :attribute es obligatorio;',
            'main_color.regex'         => 'El formato del :attribute no es un código hexadecimal válido.',

            'secondary_color.required' => 'El :attribute es obligatorio.',
            'secondary_color.regex'    => 'El formato del :attribute no es válido.',

            'topic_color.regex'        => 'El color de la barra debe ser un formato hexadecimal válido.',

            'solid_background.required' => 'El :attribute es obligatorio para casos donde no cargue la imagen.',
            'solid_background.regex'    => 'El formato del :attribute no es válido.',

            // Mensajes para la Imagen de Fondo
            'background_path.image'    => 'El archivo seleccionado para :attribute debe ser una imagen.',
            'background_path.mimes'    => 'La :attribute solo acepta formatos: jpeg, png, jpg o svg.',
            'background_path.max'      => 'La :attribute es muy pesada. El límite es de 2MB.',
        ];
    }
}
