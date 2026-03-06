<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends BaseVehicleRequest
{
    // TODO - Agregar el trait AtLeastOne

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
        $id = $this->route('id');

        return array_merge_recursive($this->uniqueRules($id), parent::rules());
    }

    public function uniqueRules(?int $id = null): array
    {
        return [
            'client_id' => ['sometimes'],
            'plate' => ['sometimes', 'unique:vehicles,plate,'.$id],
            'brand' => ['sometimes'],
            'model' => ['sometimes'],
            'manufacturing_year' => ['sometimes'],
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());

    }

    public function uniqueMessages(): array
    {
        return [
            'plate.unique' => '',
        ];
    }
}
