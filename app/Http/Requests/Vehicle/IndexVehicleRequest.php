<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class IndexVehicleRequest extends FormRequest
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
     * Reglas de validación para la Indexación de Vehículos
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
     * Mensajes de validación para la Indexación de Vehículos
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
