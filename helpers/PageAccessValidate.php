<?php 
class PageAccessValidate {
    public static function checkPageAccess() {
        if (!defined('ACESSO_VALIDO')) {
            // Bloqueia acesso direto ao arquivo
            header("Location: ".BASE_URL."index.php?page=home");
            exit;
        }
    }
}