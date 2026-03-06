<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseClientRequest extends FormRequest
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
            'lastname' => ['string', 'max:50', 'regex:/^[\p{L}\s-]+$/u'],
            'email' => ['email'],
            'dni' => ['digits:8'],
            'phone_code' => ['integer'], // Contamos que no se ingrese el "+", solo el código numérico
            'phone' => ['digits:9'], // TODO - Analizar su cambio (digits solo serviría para números en Perú)
        ];
    }

    abstract protected function uniqueRules(): array;

    public function messages(): array
    {
        return [
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre debe tener un máximo de 50 caracteres',
            'name.regex' => 'El campo nombre debe contener solo letras y espacios',

            'lastname.string' => 'El campo apellido debe ser un texto',
            'lastname.max' => 'El campo apellido debe tener un máximo de 50 caracteres',
            'lastname.regex' => 'El campo apellido debe contener solo letras y espacios',

            'dni.digits' => 'El campo DNI debe tener 8 dígitos',

            'phone_code.integer' => 'El campo código de teléfono debe ser un número entero',

            'phone.digits' => 'El campo número de teléfono debe tener 9 dígitos',
        ];
    }

    abstract protected function uniqueMessages(): array;
}
