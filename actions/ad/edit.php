<?php
require '../../config/config.php';
require '../../helpers/ValidateImages.php';
require '../../classes/Ad.php';
require '../../helpers/CsrfValidator.php';
$ads = new Ad($pdo);


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
    header("Location: ".BASE_URL."index.php?page=ad-edit&id=$id_anuncio");
    exit();
}




// Sanitização
$id_anuncio = Sanitizer::integer($_POST['id_anuncio']);
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
if($id_anuncio == null) {
    $alerts['id_anuncio'] = MessagesSystem::message('invalid', 'id_anuncio');
}


// Se não tiver nenhum erro no campos informados
if (empty($alerts)) {

    if(isset($_FILES['photos'])) {
        $photos = $_FILES['photos'];
       
        $photos = ValidateImages::validateImgs($photos, BASE_URL);      

     } else {
        $photos = array();
     }

    // Atualizando os dados e verificando se deu certo
    if( $ads->editAd($title, $category, $price, $description, $state, $user_id, $id_anuncio, $photos) ) {
        
        $logAction->addLog('Ad edited', 'Id Ad: '.$id_anuncio.' - '.$title, $userInfo['id']);
        $alerts['success'] = MessagesSystem::message('update_success');
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-edit&id=$id_anuncio");

    } else {
        $alerts['fail'] = MessagesSystem::message('update_fail');
        $_SESSION['msg'] = $alerts;
        header("Location: ".BASE_URL."index.php?page=ad-edit&id=$id_anuncio");
        exit();
    }

    
    //print_r($alerts);
} else {
    $_SESSION['msg'] = $alerts;
    header("Location: ".BASE_URL."index.php?page=ad-edit&id=$id_anuncio");
    exit();
}











exit;

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
$value = filter_input(INPUT_POST, 'value', FILTER_VALIDATE_FLOAT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$state = filter_input(INPUT_POST, 'state', FILTER_VALIDATE_INT);
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);


if( !empty($title) && !empty($category) && !empty($value) && !empty($description) && !empty($state) && !empty($id_anuncio) && !empty($user_id)) {

    if(isset($_FILES['photos'])) {
        $photos = $_FILES['photos'];
       
        $photos = ValidateImages::validateImgs($photos, $dir);      

     } else {
        $photos = array();
     }     
          
    
    if( $ads->editAd($title, $category, $value, $description, $state, $user_id, $id_anuncio, $photos) ) {
        
        $logAction->addLog('Ad edited', 'Id Ad: '.$id_anuncio.' - '.$title, $userInfo['id']);
        
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Anuncio -<b> '.$title. ' - </b> Atualizado com sucesso!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        header("Location: ../../index.php?page=ad-edit&id=$id_anuncio");
        exit();
    } else {

        $logAction->addLog('Ad no edited', 'Id Ad: '.$id_anuncio.' - '.$title, $userInfo['id']);

        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Anuncio -<b> Atenção! - </b> Não foi possível atualizar o anúncio!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        header("Location: ../../index.php?page=ad-edit&id=$id_anuncio");
        exit();
    }

} else {
    $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Atenção! </strong> Preencha todos os campos!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    header("Location: ../../index.php?page=ad-edit&id=$id_anuncio");
    exit();
}