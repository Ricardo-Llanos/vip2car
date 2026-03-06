<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends BaseClientRequest
{
    // Agregar el trait AtLeastOne

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
            'name' => ['sometimes'],
            'lastname' => ['sometimes'],
            'email' => ['sometimes', 'unique:clients,email,'.$id],
            'dni' => ['sometimes', 'unique:clients,dni,'.$id],
            'phone_code' => ['sometimes'], // Contamos que no se ingrese el "+", solo el código numérico
            'phone' => ['sometimes', 'unique:clients,phone,'.$id],
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());

    }

    public function uniqueMessages(): array
    {
        return [
            'dni.unique' => '',
            'phone.unique' => '',
        ];
    }
}
