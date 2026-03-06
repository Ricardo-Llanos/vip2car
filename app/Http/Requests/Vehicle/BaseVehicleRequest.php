<?php

namespace App\Http\Requests\Vehicle;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => ['integer', 'exists:clients,id'],
            'plate' => ['string', 'regex:/^[A-Z]{2,3}-\d{3,4}$/'],
            'brand' => ['string', 'max:50'], // TODO - verificar cantidad de 
            'model' => ['string', 'max:50'],
            'manufacturing_year' => ['integer', 'min:1886', 'max:' . Carbon::now()->year],
        ];
    }

    abstract protected function uniqueRules(): array;

    public function messages(): array
    {
        return [
            'client_id.integer' => 'El campo cliente debe ser un número entero',
            'client_id.exists' => 'El cliente no existe',

            'plate.string' => 'El campo placa debe ser un texto',
            'plate.regex' => 'El campo placa debe tener el formato XXX-XXX',

            'brand.string' => 'El campo marca debe ser un texto',
            'brand.max' => 'El campo marca debe tener un máximo de 50 caracteres',

            'model.string' => 'El campo modelo debe ser un texto',
            'model.max' => 'El campo modelo debe tener un máximo de 50 caracteres',

            'manufacturing_year.integer' => 'El campo año de fabricación debe ser un número entero',
            'manufacturing_year.min' => 'El campo año de fabricación debe ser mayor o igual a 1886',
            'manufacturing_year.max' => 'El campo año de fabricación debe ser menor o igual a la fecha actual',
        ];
    }

    abstract protected function uniqueMessages(): array;
}
