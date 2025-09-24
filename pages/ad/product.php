<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();

if(isset( $_GET['id']) && !empty($_GET['id'] && is_numeric($_GET['id'])) ) {
    $id = trim($_GET['id']);
} else {
    header("Location: index.php");
    exit;
}     

$adData = $ad->getFullAd($id);

?>
    <br>
    <div class="container-fluid">
               
        <div class="row">
            <div class="col-sm-5"> 
                <?php require 'pages/ad/carousel.php'; ?>
            </div>
            <div class="col-sm-7"> 
                <h1><?= Sanitizer::safeOutput($adData['titulo']); ?></h1>
                <h4><?= Sanitizer::safeOutput($adData['categoria']); ?></h4>
                <p><?= Sanitizer::safeOutput($adData['descricao']); ?></p>
                <br/>
                <h3>R$ <?= htmlspecialchars(number_format($adData['valor'], 2)); ?></h3>
                <h4>Telefone para contato: <?= htmlspecialchars($adData['telefone'] ?? ''); ?></h4>
            </div>
        </div>
            
    </div>

<?php
    require 'pages/footer.php';