<?php
class Sanitizer {

    public static function string(?string $value): ?string {
        return trim(filter_var($value, FILTER_SANITIZE_STRING));       
    }

    public static function integer($value): ?int {
        return trim(filter_var($value, FILTER_SANITIZE_STRING));
    }

    public static function float($value): ?float {
        return (float) filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function email($value): ?string {
        return trim(filter_var($value, FILTER_SANITIZE_EMAIL));
    }

    public static function array($value): ?array {
        
        if(is_array($value) && !empty($value)) {
            return $value;
        } else {
            return null;
        }
    }

    public static function date($value, $format = 'Y-m-d'): ?string {
        $date = DateTime::createFromFormat($format, $value);

        if($date && $date->format($format) === $value) {
            return $date;
        } else {
            return null;
        }
    }
    
    public static function phone($value): ?string {
        $value = preg_replace('/\D/', '', $value); // mantém só números
        
        if(strlen($value) >= 10 && strlen($value) <= 11) {
            return $value;
        } else {
            return null;
        }
    }

    public static function safeOutput(string $text): string {
        // Detecta a codificação original
        $encoding = mb_detect_encoding($text, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);
        if ($encoding === false) {
            $encoding = 'UTF-8';
        }

        // Garante UTF-8
        $utf8 = mb_convert_encoding($text, 'UTF-8', $encoding);

        // Decodifica entidades existentes (&eacute; -> é)
        $decoded = html_entity_decode($utf8, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Escapa novamente de forma limpa
        return htmlspecialchars($decoded, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
    
    public static function validatePasswordStrong($password, $minLength = 8): ?string {
        if( 
            strlen($password) >= $minLength &&
            preg_match('/[A-Z]/', $password) &&    // pelo menos 1 maiúscula
            preg_match('/[a-z]/', $password) &&    // pelo menos 1 minúscula
            preg_match('/[0-9]/', $password) &&    // pelo menos 1 número
            preg_match('/[\W_]/', $password) )     // pelo menos 1 caracter especial
        {
            return $password;
        } else {
            return null;
        }
    }


}
