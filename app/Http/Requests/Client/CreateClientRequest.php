<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends BaseClientRequest
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
            'lastname' => ['required'],
            'email' => ['required', 'unique:clients,email'],
            'dni' => ['required', 'unique:clients,dni'],
            'phone_code' => ['sometimes'], // Contamos que no se ingrese el "+", solo el código numérico
            'phone' => ['required', 'unique:clients,phone'],
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

            'lastname.required' => 'El campo apellido es obligatorio',

            'dni.required' => 'El campo DNI es obligatorio',
            'dni.unique' => 'El DNI ya se encuentra registrado',

            'phone.required' => 'El campo número de teléfono es obligatorio',
            'phone.unique' => 'El número de teléfono ya se encuentra registrado',
        ];
    }
}
