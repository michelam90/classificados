<?php 
require '../../config/config.php';
require '../../classes/Ad.php';
require '../../helpers/CsrfValidator.php';
$ad = new Ad($pdo); 


$alerts = [];
// Verifica se a requisição a essa pagina é via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {
    $alerts['request_method'] = MessagesSystem::message('denied', 'Permissão negada!');
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-my-ads");
    exit();
}


// Validar o token contra ataque CSRF no POST
$csrf_token = !empty($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

if ( CsrfValidator::check($csrf_token) == false ) {
    $alerts['csrf_token'] = MessagesSystem::message('denied', 'Formulário negado!');
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-my-ads");
    exit();
}

$id_anuncio = Sanitizer::integer($_POST['id']);
$titulo = Sanitizer::string($_POST['name']);


if($id_anuncio == null) {
    $alerts['id_anuncio'] = MessagesSystem::message('invalid', 'ID anúncio');
}


// Se não tiver nenhum erro no campos informados
if (empty($alerts)) {

    if( $ad->deleteAd($id_anuncio) ) {
        $logAction->addLog('Ad deleted', 'Id Ad: '.$id_anuncio, $userInfo['id']);
        $alerts['success'] = MessagesSystem::message('delete_success', $titulo);
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-my-ads");
    } else {
        $alerts['fail'] = MessagesSystem::message('delete_fail', $titulo);
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-my-ads");
        exit();
    }

} else {
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-my-ads");
    exit();
}

