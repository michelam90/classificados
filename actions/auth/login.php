<?php
require '../../config/config.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if( !empty($email) && !empty($password) ) {
 
    if( $auth->validateLogin($email, $password) ) {
        $logAction->addLog('Login success', 'Login success', $userInfo['id']);
        header("Location: ../../index.php");
    } else {
       $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Atenção! </strong> Usuário ou senha incorreto, tente novamente!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        header("Location: ../../index.php?page=auth-login");
    }

} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Atenção! </strong> informe todos os campos!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    header("Location: ../../index.php?page=auth-login");
}