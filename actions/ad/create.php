<?php 
require '../../config/config.php';
require '../../classes/Ad.php';
require '../../helpers/CsrfValidator.php';
$ads = new Ad($pdo);

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
$title = Sanitizer::string($_POST['title']);
$category = Sanitizer::integer($_POST['category']);
$price = Sanitizer::float($_POST['price']);
$description = Sanitizer::string($_POST['description']);
$state = Sanitizer::integer($_POST['state']);
$user_id = $userInfo['id'];


if($title == null) {
    $alerts['title'] = MessagesSystem::message('invalid', 'Titulo');
}
if($category == null) {
    $alerts['category'] = MessagesSystem::message('invalid', 'Categoria');
}
if($price == null) {
    $alerts['price'] = MessagesSystem::message('invalid', 'Preço');
}
if($description == null) {
    $alerts['description'] = MessagesSystem::message('invalid', 'Descrição');
}
if($state == null) {
    $alerts['state'] = MessagesSystem::message('invalid', 'Estado');
}


// Se não tiver nenhum erro no campos informados
if (empty($alerts)) {
    // Adicionando os dados e verificando se deu certo
    if( $ads->addAd($title, $category, $price, $description, $state, $user_id) ) {

        $logAction->addLog('Ad created', 'Categoria: '.$category.' - '.$title, $userInfo['id']);
        $alerts['success'] = MessagesSystem::message('create_success');
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-my-ads");
    
    } else {
        $alerts['fail'] = MessagesSystem::message('create_fail');
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-create");
        exit();
    }
    //print_r($alerts);
} else {
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-create");
    exit();
}
