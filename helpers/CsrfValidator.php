<?php

class CsrfValidator 
{
    private const TOKEN_EXPIRY = 600; // 10 minutos

    /**
     * Gera e retorna um token CSRF único para o formulário
     */
    public static function generateToken(): string {
        if (!isset($_SESSION['csrf_tokens'])) {
            $_SESSION['csrf_tokens'] = [];
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_tokens'][$token] = time();

        // Limpa tokens expirados
        foreach ($_SESSION['csrf_tokens'] as $t => $time) {
            if ($time + self::TOKEN_EXPIRY < time()) {
                unset($_SESSION['csrf_tokens'][$t]);
            }
        }

        return $token;
    }

    

    /**
     * Valida o token recebido no POST
     */
    public static function check(string $tokenFromPost): bool {
        if (!isset($_SESSION['csrf_tokens'][$tokenFromPost])) {
            return false;
        }

        // Remove token usado
        unset($_SESSION['csrf_tokens'][$tokenFromPost]);
        return true;
    }
}
