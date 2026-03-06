<?php

namespace App\Helpers;

class DataFormatter
{
    /*================================================
        Constantes de los métodos
    =================================================*/
    public const USER_NAME_FORMAT = 'userNameFormat';
    public const EMAIL_FORMAT = 'emailFormat';
    public const PLATE_FORMAT = 'plateFormat';
    public const BRAND_FORMAT = 'brandFormat';
    public const MODEL_FORMAT = 'modelFormat';

    /*================================================
        Aplicación de los métodos
    =================================================*/
    /**
     * Formatea nombres a upper case
     * 
     * @param string $value - Cadena de caracteres a convertir a upper case
     * @param bool $trim - Indica si se debe limpiar la cadena
     * @return string - Cadena con el formato
     */
    public static function userNameFormat(string $value, bool $trim=true): string
    {
        if (empty($value)) {
            return $value;
        }

        $value = $trim ? self::trim($value) : $value;

        return self::capitalizeCase($value);
    }

    /**
     * Formatea nombres a lower case
     * 
     * @param string $value - Cadena de caracteres que será convertida a lower case
     * @param bool $trim - Indica si se debe limpiar la cadena
     * @return string - Cadena con el formato
     */
    public static function emailFormat(string $value, bool $trim=true): string
    {
        if (empty($value)) {
            return $value;
        }

        $value = $trim ? self::trim($value) : $value;

        return self::lowerCase($value);
    }

    /**
     * Formatea nombres a upper_case
     * 
     * @param string $value - Cadena de caracteres que será convertida a upper_case
     * @param bool $trim - Indica si se debe limpiar la cadena
     * @return string - Cadena con el formato
     */
    public static function plateFormat(string $value, bool $trim=true): string
    {
        if (empty($value)) {
            return $value;
        }

        $value = $trim ? self::trim($value) : $value;

        return self::upperCase($value);
    }

    /**
     * Formatea nombres con capitalización estándar
     * 
     * @param string $value - Cadena de caracteres que será capitalizada
     * @param bool $trim - Indica si se debe limpiar la cadena
     * @return string - Cadena con el formato
     */
    public static function brandFormat(string $value, bool $trim=true): string
    {
        if (empty($value)) {
            return $value;
        }

        $value = $trim ? self::trim($value) : $value;

        return self::capitalizeCase($value);
    }
    
    /**
     * Formatea nombres con capitalización estándar
     * 
     * @param string $value - Cadena de caracteres que será capitalizada
     * @param bool $trim - Indica si se debe limpiar la cadena
     * @return string - Cadena con el formato
     */
    public static function modelFormat(string $value, bool $trim=true): string
    {
        if (empty($value)) {
            return $value;
        }

        $value = $trim ? self::trim($value) : $value;

        return self::capitalizeCase($value);
    }

    /*================================================
        Métodos "Helpers"
    =================================================*/
    private static function trim(string $value): string
    {
        $value = trim($value);
        $value = preg_replace('/\s+/', ' ', $value);

        return $value;
    }

    private static function upperCase(string $value): string
    {
        return mb_strtoupper($value);
    }

    private static function capitalizeCase(string $value): string
    {
        $lower = mb_strtolower($value);
        return mb_convert_case($lower, MB_CASE_TITLE, 'UTF-8');
    }

    private static function lowerCase(string $value): string
    {
        return mb_strtolower($value);
    }
}
