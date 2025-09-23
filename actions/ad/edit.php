<?php
require '../../config/config.php';
require '../../helpers/FormatImages.php';
require '../../classes/Ad.php';
require '../../helpers/CsrfValidator.php';

$ads = new Ad($pdo);
$errors = []; // erros graves
$alerts = []; // avisos de imagens, etc.

// Verifica se a requisição a essa pagina é via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {
    $errors[] = MessagesSystem::message('denied_method');
    $url = BASE_URL."index.php?page=ad-edit&id=$id_anuncio";
    Redirect::redirectWithMessage($url, $errors);
    exit();
}


// Sanitização inicial
$id_anuncio = Sanitizer::integer($_POST['id_anuncio'] ?? null);
$csrf_token = $_POST['csrf_token'] ?? '';

// Verificação CSRF
if ( CsrfValidator::check($csrf_token) == false ) {
    $errors[] = MessagesSystem::message('denied_csrf');
    $url = BASE_URL."index.php?page=ad-edit&id=$id_anuncio";
    Redirect::redirectWithMessage($url, $errors);
    exit();
}


// Sanitização dos dados recebidos
$title       = Sanitizer::string($_POST['title'] ?? null);
$category    = Sanitizer::integer($_POST['category'] ?? null);
$price       = Sanitizer::float($_POST['price'] ?? null);
$description = Sanitizer::string($_POST['description'] ?? null);
$state       = Sanitizer::integer($_POST['state'] ?? null);
$user_id     = Sanitizer::integer($userInfo['id'] ?? null);

// Validação das variaveis
if(empty($title)) {
    $errors[] = MessagesSystem::message('required', 'Titulo');
}
if(empty($category)) {
    $errors[] = MessagesSystem::message('required', 'Categoria');
}
if(empty($price)) {
    $errors[] = MessagesSystem::message('required', 'Preço');
}
if(empty($description)) {
    $errors[] = MessagesSystem::message('required', 'Descrição');
}
if(empty($state)) {
    $errors[] = MessagesSystem::message('required', 'Estado');
}


// Validação e formatação das imagens
$photos = [];
if(!empty($_FILES['photos']['name'][0])) {
    foreach ($_FILES['photos']['name'] as $i => $name) {
        $size = $_FILES['photos']['size'][$i];
        $type = $_FILES['photos']['type'][$i];
        $tmp  = $_FILES['photos']['tmp_name'][$i];

        $invalidFile = false;

        if (!Validator::maxSize($size, 2*1024*1024)) {
            $alerts[] = MessagesSystem::message('upload_size', $name);
            $invalidFile = true;
        }

        if (!Validator::allowedMimeTypes($type, ['image/jpeg','image/png'])) {
            $alerts[] = MessagesSystem::message('upload_type', $name);
            $invalidFile = true;
        }

        if (!$invalidFile) {
            $result = FormatImages::format($tmp, $name, $type, 'anuncios/');
            if ($res['error']) {
                $alerts[] = $result['error'];
            } else {
                $photos[] = $result['success'];
            }
        }
    }
}



// Se não tiver nenhum erro no campos informados
if (empty($errors)) {    

    // Atualizando os dados e verificando se deu certo
    if( $ads->editAd($title, $category, $price, $description, $state, $user_id, $id_anuncio, $photos) ) {
        
        $logAction->addLog('Ad edited', 'Id Ad: '.$id_anuncio.' - '.$title, $user_id);
        $alerts[] = MessagesSystem::message('update_success');

    } else {
        $alerts[] = MessagesSystem::message('update_fail');
    }   

}

// Capturando todas as mensagens e redirecionando
$messages = array_merge($errors, $alerts);
$url = BASE_URL."index.php?page=ad-edit&id=$id_anuncio";
Redirect::redirectWithMessage($url, $messages);
exit();






