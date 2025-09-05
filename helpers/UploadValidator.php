<?php
class UploadValidator {

    
    /**
     * Valida o tamanho máximo do arquivo (em bytes)
     * ex: if (!UploadValidator::maxSize($file, 5 * 1024 * 1024)) { $errors[] = "Arquivo muito grande. Máximo 5MB."; }
     */
    public static function maxSize(array $file, int $maxBytes): bool {

        if( isset($file['size']) && $file['size'] <= $maxBytes ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Valida tipo MIME do arquivo
     * ex: if (!UploadValidator::allowedMimeTypes($file, ['jpg', 'png', 'pdf'])) { $errors[] = "Extensão inválida. Permitido: jpg, png, pdf."; }
     */
    public static function allowedMimeTypes(array $file, array $mimeTypes): bool {

        if( isset($file['type']) && in_array($file['type'], $mimeTypes) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gera nome único para salvar o arquivo
     */
    public static function generateFilename(array $file): string {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newName = uniqid('', true) . '.' . $ext;
        return $newName;
    }
}
