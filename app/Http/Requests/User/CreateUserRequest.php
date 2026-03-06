<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends BaseUserRequest
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
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            // 'password' => ['required'] // Una por defecto
        ];
    }

    public function messages(): array
    {
        return array_merge_recursive($this->uniqueMessages(), parent::messages());
    }

    public function uniqueMessages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya se encuentra registrado',
        ];
    }
}
