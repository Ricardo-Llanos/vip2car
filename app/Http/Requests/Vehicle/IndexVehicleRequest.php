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
            'page.min' => 'El campo página debe ser un número entero mayor o igual a 1',
            'page.integer' => 'El campo página debe ser un número entero',

            'per_page.integer' => 'El campo número de registros por página debe ser un número entero',
            'per_page.min' => 'El campo número de registros por página debe ser un número entero mayor o igual a 10',
            'per_page.max' => 'El campo número de registros por página debe ser un número entero menor o igual a 50',
        ];
    }
}
