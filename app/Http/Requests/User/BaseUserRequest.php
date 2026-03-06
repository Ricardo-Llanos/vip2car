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
            'password' => ['confirmed', 
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
            'name.string' => '',
            'email.email' => '',
            'password.confirmed' => '',
            'password.min' => '',
            'password.mixed' => '',
            'password.numbers' => '',
            'password.symbols' => '',
        ];
    }

    abstract protected function uniqueMessages(): array;

}
