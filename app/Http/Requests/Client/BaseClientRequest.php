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
            'name.string' => '',
            'name.max' => '',
            'name.regex' => '',

            'lastname.string' => '',
            'lastname.max' => '',
            'lastname.regex' => '',

            'dni.digits' => '',

            'phone_code.integer' => '',
            
            'phone.digits' => '',
        ];
    }

    abstract protected function uniqueMessages(): array;
}
