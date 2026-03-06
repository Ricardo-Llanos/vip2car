<?php

namespace App\Http\Requests\Client;

use App\Helpers\DataFormatter;
use App\Http\Requests\Trait\PrepareData;
use Illuminate\Foundation\Http\FormRequest;

class SearchClientRequest extends FormRequest
{
    use PrepareData;

    /**
     * Array de campos a formatear (Ver trait PrepareData)
     * 
     * @var array<string,DataFormatter::FORMAT_METHOD> $prepare
     */
    protected array $prepare = [
        'name' => DataFormatter::USER_NAME_FORMAT,
        'lastname' => DataFormatter::USER_NAME_FORMAT,
        'email' => DataFormatter::EMAIL_FORMAT
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
            'name' => ['sometimes', 'string', 'max:50', 'regex:/^[\p{L}\s-]+$/u'],
            'lastname' => ['sometimes', 'string', 'max:50', 'regex:/^[\p{L}\s-]+$/u'],
            'email' => ['sometimes', ],
            'dni' => ['sometimes', ],
            'phone_code' => ['sometimes', ], // Contamos que no se ingrese el "+", solo el código numérico
            'phone' => ['sometimes', ], // TODO - Analizar su cambio (digits solo serviría para números en Perú)

            'page' => ['sometimes', 'min:1', 'integer'],
            'per_page' => ['sometimes', 'integer', 'min:10', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre debe tener un máximo de 50 caracteres',
            'name.regex' => 'El campo nombre debe contener solo letras y espacios',

            'lastname.string' => 'El campo apellido debe ser un texto',
            'lastname.max' => 'El campo apellido debe tener un máximo de 50 caracteres',
            'lastname.regex' => 'El campo apellido debe contener solo letras y espacios',

            'phone_code.integer' => 'El campo código de teléfono debe ser un número entero',

            'page.min' => 'El campo página debe ser un número entero mayor o igual a 1',
            'page.integer' => 'El campo página debe ser un número entero',

            'per_page.integer' => 'El campo número de registros por página debe ser un número entero',
            'per_page.min' => 'El campo número de registros por página debe ser un número entero mayor o igual a 10',
            'per_page.max' => 'El campo número de registros por página debe ser un número entero menor o igual a 50',

        ];
    }
}
