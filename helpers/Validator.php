<?php 
class Validator {
    
    public static function string(string $value, int $min = 1, int $max = 255): bool {
        $len = mb_strlen($value);
        return $len >= $min && $len <= $max;
    }

    public static function int(int $value, int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): bool {
        return $value >= $min && $value <= $max;
    }

    public static function float(float $value, float $min = PHP_FLOAT_MIN, float $max = PHP_FLOAT_MAX): bool {
        return $value >= $min && $value <= $max;
    }

    /**
     * Valida o tamanho máximo do arquivo (em bytes)
     * Use assim para loops if(!UploadValidator::maxSize($fotos['size'][$i], 2 * 1024 * 1024)) { não atende; exit;}
     * Use assim para arquivos individuais if (!UploadValidator::maxSize($fotos['file']['size'], 2 * 1024 * 1024)) { não atende; exit;}
     */
    public static function maxSize(int $fileSize, int $maxBytes): bool {
        if($fileSize <= $maxBytes) {
            return true;
        } else {
            return false;
        }
    }

    
    /**
     * Valida tipo MIME do arquivo
     * Use assim em loops if(!UploadValidator::allowedMimeTypes($fotos['type'][$i], ['image/jpeg', 'image/png'])) { não atende; exit;}
     * Use assim para um arquivo só if(!UploadValidator::allowedMimeTypes($fotos['file']['type'], ['image/jpeg', 'image/png'])) { não atende; exit;}
     */
    public static function allowedMimeTypes(string $fileMimeType, array $mimeTypes): bool {

        if( in_array($fileMimeType, $mimeTypes) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gera nome único para salvar o arquivo
     * Use assim dentro de loops: UploadValidator::generateFilename($fotos['name'][$i])
     * Use assim para validar um arquivo unico UploadValidator::generateFilename($fotos['name'])
     */
    public static function generateFilename(string $filename): string {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return uniqid('', true) . '.' . $ext;
    }
}