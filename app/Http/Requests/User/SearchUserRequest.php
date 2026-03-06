<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SearchUserRequest extends BaseUserRequest
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
            'name' => ['sometimes'],
            'email' => ['sometimes'],
            // 'password' => ['required'] // Una por defecto

            'page' => ['sometimes', 'min:1', 'integer'],
            'per_page' => ['sometimes', 'integer', 'min:10', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());
    }

    public function uniqueMessages(): array
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
