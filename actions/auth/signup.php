<?php
require '../../config/config.php';
require '../../helpers/CsrfValidator.php';

$alerts = [];
// Verifica se a requisição a essa pagina é via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {
    $alerts['request_method'] = MessagesSystem::message('denied', 'Permissão negada!');
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-create");
    exit();
}


// Validar o token contra ataque CSRF no POST
$csrf_token = !empty($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

if ( CsrfValidator::check($csrf_token) == false ) {
    $alerts['csrf_token'] = MessagesSystem::message('denied', 'Formulário negado!');
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-create");
    exit();
}




// Sanitização
$name = Sanitizer::string($_POST['name']);
$email = Sanitizer::email($_POST['email']);
$password = Sanitizer::validatePasswordStrong($_POST['password']);
$phone = Sanitizer::phone($_POST['telefone']);

if($name == null) {
    $alerts['name'] = MessagesSystem::message('invalid', 'Nome');
}
if($email == null) {
    $alerts['email'] = MessagesSystem::message('invalid', 'E-mail');
}
if($password == null) {
    $alerts['password'] = MessagesSystem::message('invalid', 'Senha', 
    'A senha deve conter no minimo:<br/>
        * 8 caracteres;<br/> 
        * Uma letra maiúscula;<br/> 
        * Uma letra minúscula;<br/>
        * Um número; e <br/>
        * Um caraceter especial.');
}
if($phone == null) {
    $alerts['phone'] = MessagesSystem::message('invalid', 'Telefone');
}


// Se não tiver nenhum erro no campos informados
if (empty($alerts)) {

    // Verifica se o cadastro foi realizado
    if( $user->registerUser($name, $email, $password, $phone) ) {
        // registra log
        $logAction->addLog('New register user', 'New register user', 0);
        // Verifica a senha e login e já loga o usuário
        if( $auth->validateLogin($email, $password) ) {
            $logAction->addLog('Login success', 'Login success', $userInfo['id']);
            
            header("Location: ".BASE_URL."index.php?page=home");
        } else {

            $alerts['success'] = MessagesSystem::message('login');
            $_SESSION['msg'] = $alerts;
            header("Location: ".BASE_URL."index.php?page=auth-login");            
        }

    } else {
        $alerts['fail'] = MessagesSystem::message('already_exists');
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=auth-login"); 
    }

} else {
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=auth-signup");
    exit();
}
