<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends BaseUserRequest
{
// Agregar el AtLeastOne;

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
            'email' => ['sometimes', 'unique:users,email,' . $id],
            'password' => ['sometimes'] // Una por defecto
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());
    }

    public function uniqueMessages(): array
    {
        return [
            'email.unique' => 'El correo electrónico ya se encuentra registrado',
        ];
    }
}
