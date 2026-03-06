<?php

namespace App\Http\Requests\Trait;
use App\Helpers\DataFormatter;

/**
 * El trait PrepareData nos permite poder formatear la información de un request antes de que esta pase a las reglas de validación.
 * 
 * @property array<string,DataFormatter::FORMAT_METHOD> $prepare
 *  El array necesita tener una forma bastante concreta
 * @example[
 *     'field' => DataFormatter::FORMAT_METHOD,
 *     'field' => DataFormatter::FORMAT_METHOD,
 *     'field' => DataFormatter::FORMAT_METHOD]
 * 
 * @method prepareForValidation(): void
 * 
 * @package App\Http\Requests\Traits
 * @category Trait
 * @version 1.0.0 - 2026/03/06
 *
 * @author Ricardo Llanos <e_2022101111G@uncp.edu.pe>
 */
trait PrepareData
{
    /**
     * Sobreescribe el método prepareForValidation para formatear la información del request.
     * 
     * @return void
     */
    public function prepareForValidation(): void
    {
        // --- Verificamos si el arreglo de formatos se ha definido ---
        if (!property_exists($this, "prepare")){
            return ;
        }

        $merged = array();

        // --- Recorremos el arreglo de formatos ---
        foreach ($this->prepare as $field => $method){
            if ($this->has($field) && !empty($this->get($field))) {
                $merged[$field] = DataFormatter::$method($this->get($field));
            }
        }

        // --- Si hay datos formateados, los agregamos al request ---
        if (!empty($merged)){
            $this->merge($merged);
        }
    }
}
