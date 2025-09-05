<?php 
require '../../config.php';
require '../../classes/Ad.php';
$ad = new Ad($pdo); 

if(isset($_GET['id']) && !empty($_GET['id'])) {
    if(is_numeric($_GET['id'])) {

        $id = trim(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));

        if( $ad->deleteImageById($id) ) {
            $logAction->addLog('Photo Ad deleted', 'Id Photo: '.$id, $userInfo['id']);
        }       
    }
}


if(!empty($_GET['id_anuncio']) && is_numeric($_GET['id_anuncio'])) {

    $id_anuncio = trim(filter_input(INPUT_GET, 'id_anuncio', FILTER_VALIDATE_INT));

    header("Location: ../../index.php?page=ad-edit&id=".$id_anuncio);
} else {
    header("Location: ../../index.php?page=ad-my-ads");
}
