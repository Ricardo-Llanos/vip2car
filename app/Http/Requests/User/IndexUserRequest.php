<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
{
    /**
     * Valida que el usuario autenticado tenga permisos para realizar la acción.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para la Indexación de usuarios
     *
     * @return array<string,\Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'min:1', 'integer'],
            'per_page' => ['sometimes', 'integer', 'min:10', 'max:50'],
        ];
    }

    /**
     * Mensajes de validación para la Indexación de Usuarios
     *
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'page.min' => '',
            'page.integer' => '',

            'per_page.integer' => '',
            'per_page.min' => '',
            'per_page.max' => '',
        ];
    }
}
