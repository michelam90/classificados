<?php
// logger.php
require __DIR__ . '/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

// ===== CONFIGURAÇÃO DO AMBIENTE =====
define('APP_ENV', 'dev'); // 'dev' ou 'prod'

// Cria instância global do Logger
$logger = new Logger('system');

// Define o destino do log (pasta logs/system.log)
$logPath = __DIR__ . '/../logs/system.log';

// Rotaciona diariamente, mantém últimos 30 arquivos
$logger->pushHandler(new RotatingFileHandler($logPath, 30, Logger::DEBUG));

// ================================
// Handlers globais para capturar erros
// ================================

// Captura exceptions não tratadas
set_exception_handler(function ($e) use ($logger) {
    $logger->error("Exceção não tratada", [
        'type' => get_class($e),
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);

    // Mostrar na tela se estiver em dev
    if (APP_ENV === 'dev' && PHP_SAPI !== 'cli') {
        echo "<b>Exceção:</b> {$e->getMessage()} em {$e->getFile()}:{$e->getLine()}<br>";
        echo nl2br($e->getTraceAsString());
    }
});

// Captura warnings, notices e outros erros do PHP
set_error_handler(function ($severity, $message, $file, $line) use ($logger) {
    $logger->error("Erro PHP", [
        'severity' => getErrorType($severity),
        'message' => $message,
        'file' => $file,
        'line' => $line
    ]);

    // Exibe na tela no ambiente de desenvolvimento
    if (APP_ENV === 'dev' && PHP_SAPI !== 'cli') { // só se não for CLI
        echo "<b>". getErrorType($severity) ." :</b> $message em $file:$line<br>";
    }
});

// Captura fatal errors no shutdown
register_shutdown_function(function () use ($logger) {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
        $logger->critical("Fatal Error", $error);

        if (defined('APP_ENV') && APP_ENV === 'dev' && PHP_SAPI !== 'cli') {
            echo "<b>Fatal Error:</b> {$error['message']} em {$error['file']}:{$error['line']}<br>";
        }
    }
});




// Retorna a instância (para ser usada no config.php)
return $logger;



// Functions
function getErrorType($severity) {
    $types = [
        E_ERROR => 'Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parse Error',
        E_NOTICE => 'Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_COMPILE_ERROR => 'Compile Error',
        E_COMPILE_WARNING => 'Compile Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Strict',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_DEPRECATED => 'Deprecated',
        E_USER_DEPRECATED => 'User Deprecated',
    ];
    return $types[$severity] ?? "Unknown Error ($severity)";
}
