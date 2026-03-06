<?php

namespace App\Http\Requests\Authorization;

use App\Helpers\DataFormatter;
use App\Http\Requests\Trait\PrepareData;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    use PrepareData;

    /**
     * Array de campos a formatear (Ver trait PrepareData)
     * 
     * @var array<string,DataFormatter::FORMAT_METHOD> $prepare
     */
    protected array $prepare = [
        'email' => DataFormatter::EMAIL_FORMAT,
    ];

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
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.email' => 'El campo correo electrónico debe ser un correo electrónico válido',
            'email.users' => 'Usuario u contraseña incorrecta. Inténtelo nuevamente',

            'password.required' => 'El campo contraseña es obligatorio',
        ];
    }
}
