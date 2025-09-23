<?php 

class Redirect {

    public static function redirectWithMessage(string $url, array $messages): void {

        if(!isset($_SESSION['msg'])) {
            $_SESSION['msg'] = [];
        }

        $_SESSION['msg'] = array_merge($_SESSION['msg'], $messages);
        header("Location: $url");
        exit();
    }

}