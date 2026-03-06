<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

abstract class BaseUserRequest extends FormRequest
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
            'name' => ['string', 'max:50', 'regex:/^[\p{L}\s-]+$/u'],
            'email' => ['email'],
            'password' => [
                'confirmed',
                Password::min(8)
                    ->mixedCase() // mayúsculas y minúsculas
                    ->numbers() // números
                    ->symbols() // símbolos
            ],
        ];
    }

    abstract protected function uniqueRules(): array;

    public function messages(): array
    {
        return [
            'name.string' => 'El campo nombre debe ser un texto',
            'email.email' => 'El campo correo electrónico debe ser un correo electrónico válido',

            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.mixed' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un símbolo',
            'password.numbers' => 'La contraseña debe contener al menos un número',
            'password.symbols' => 'La contraseña debe contener al menos un símbolo',
        ];
    }

    abstract protected function uniqueMessages(): array;
}
