<?php

namespace App\Logging;

interface LoggerInterface
{
    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "debug"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function debug(string $message, array $context = []): void;

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "info"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function info(string $message, array $context = []): void;

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "notice"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function notice(string $message, array $context = []): void;

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "warning"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function warning(string $message, array $context = []): void;

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "error"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function error(string $message, array $context = []): void;
}
