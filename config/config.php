<?php 
session_start();

define('BASE_URL', 'http://localhost/classificados/');


// páginas públicas
$publicPages = [
    '/classificados/index.php?page=home',
    '/classificados/index.php?page=ad-product',
    '/classificados/index.php?page=auth-login',
    '/classificados/index.php?page=auth-signup',
    '/classificados/index.php',
    '/classificados/actions/auth/login.php',
    '/classificados/actions/user/create.php',
    '/classificados/actions/auth/signup.php',
];

// Pegando o caminho da pagina atual
$currentPage = $_SERVER['SCRIPT_NAME'];

// Pega o valor de ?page (se existir)
if(!empty($_GET['page'])) {
    $currentPage = $currentPage.'?page='.$_GET['page'];
}

// se não for pública e não tiver login → redireciona
if (!in_array($currentPage, $publicPages) && empty($_SESSION['token'])) {
    header("Location: ".BASE_URL."index.php?page=auth-login");
    exit;
}

// Carrega o logger para usar em todo o sistema
$logger = require __DIR__ . '/logger.php';

// Classes de validação e notificação
require __DIR__ . '/../helpers/Sanitizer.php';
require __DIR__ . '/../helpers/MessagesSystem.php';

// Arquivo com as configuração de acesso ao banco de dados
require_once __DIR__ . '/connection.php';

require_once __DIR__ . '/../classes/User.php';
$user = new User($pdo);

require __DIR__ . '/../classes/Auth.php';
$auth = new Auth($pdo, BASE_URL);
require __DIR__ . '/../classes/LogSystem.php';
$logAction = new LogSystem($pdo);

$userInfo = $auth->checkToken();
if(!$userInfo) {
    $userInfo['id'] = 0;
}


