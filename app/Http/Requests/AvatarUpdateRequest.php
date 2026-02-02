<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        // Asegúrate de cambiar esto a lógica real si necesitas proteger la ruta
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'name_avatar' => ['required', 'string', 'min:4', 'max:20'],
            'avatar_path' => ['required', 'image', 'mimes:png', 'max:5000'],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'name_avatar.required' => 'El :attribute es obligatorio.',
            'name_avatar.unique'   => 'Este :attribute ya está registrado.',
            'name_avatar.min'      => 'El :attribute debe tener al menos :min caracteres.',
            'name_avatar.max'      => 'El :attribute no debe exceder los :max caracteres.',

            'avatar_path.required' => 'La imagen del avatar es obligatoria.',
            'avatar_path.image'    => 'El archivo debe ser una imagen.',
            'avatar_path.mimes'    => 'El avatar solo puede ser en formato PNG.',
            'avatar_path.max'      => 'La imagen no debe pesar más de 5MB.',
        ];
    }

    /**
     * Atributos personalizados para los mensajes.
     */
    public function attributes(): array
    {
        return [
            'name_avatar' => 'nombre del avatar',
            'avatar_path' => 'imagen de perfil',
        ];
    }
}
