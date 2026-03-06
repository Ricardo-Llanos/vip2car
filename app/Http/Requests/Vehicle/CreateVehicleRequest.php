<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends BaseVehicleRequest
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
        return array_merge_recursive($this->uniqueRules(), parent::rules());
    }

    public function uniqueRules(): array
    {
        return [
            'client_id' => ['required'],
            'plate' => ['required', 'unique:vehicles,plate'],
            'brand' => ['required'],
            'model' => ['required'],
            'manufacturing_year' => ['required'],
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());

    }

    public function uniqueMessages(): array
    {
        return [
            'client_id.required' => '',

            'plate.required' => '',
            'plate.unique' => '',

            'brand.required' => '',

            'model.required' => '',

            'manufacturing_year.required' => '',
        ];
    }
}
