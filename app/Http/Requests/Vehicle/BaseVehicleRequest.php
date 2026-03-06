<?php

namespace App\Http\Requests\Vehicle;

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
            'plate' => ['string', 'regex:/^[A-Z]{2,3}-\d{3,4}'],
            'brand' => ['string', 'max:50'], // TODO - verificar cantidad de 
            'model' => ['string', 'max:50'],
            'manufacturing_year' => ['date', 'minus_or_equal:'.now()],
        ];
    }

    abstract protected function uniqueRules(): array;

    public function messages(): array
    {
        return [
            'client_id.integer' => '',
            'client_id.exists' => '',

            'plate.string' => '',
            'plate.regex' => '',

            'brand.string' => '',
            'brand.max' => '',

            'model.string' => '',
            'model.max' => '',

            'manufacturing_year.digits' => '',
        ];
    }

    abstract protected function uniqueMessages(): array;

}
