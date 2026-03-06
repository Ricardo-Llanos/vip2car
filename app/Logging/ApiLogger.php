<?php

namespace App\Logging;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiLogger implements LoggerInterface
{
    private $channel = 'app_api';
    private $prefix = 'API: ';
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {}

    private function addContext(array $context){
        $previousContext = [
            'user_id' => Auth::check() ? Auth::id() : 'unauthenticathed'
        ];

        return empty($context) ? $previousContext : array_merge($previousContext, $context);
    }

    private function writeLog(string $level, string $message, array $context = []) : void
    {
        $context = $this->addContext($context);

        Log::channel($this->channel)->log(
            level: $level,
            message: $this->prefix . $message,
            context: $context
        );
    }

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "debug"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->writeLog('debug', $message, $context);
    }

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "info"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->writeLog('info', $message, $context);
    }

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "notice"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function notice(string $message, array $context = []): void
    {
        $this->writeLog('notice', $message, $context);
    }

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "warning"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->writeLog('warning', $message, $context);
    }

    /**
     * Interfaz especializada para el manejo de los logs del sistema de nivel "error"
     * 
     * @param string $message - Mensaje del log
     * @param array{...} $context - Contexto del log
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->writeLog('error', $message, $context);
    }
}
