<?php 
require '../../config.php';
require '../../classes/Ad.php';
$ad = new Ad($pdo); 

if(isset($_GET['id']) && !empty($_GET['id'])) {
    if(is_numeric($_GET['id'])) {
       
        $id = trim(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));

        if( $ad->deleteAd($id) ) {
            $logAction->addLog('Ad deleted', 'Id Ad: '.$id, $userInfo['id']);
        }       
    }
}

header("Location: ../../index.php?page=ad-my-ads");