<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();
?>

<div class="container">
    <h1>Meus Anúncios</h1>

    <a href="index.php?page=ad-create" class="btn btn-dark"> Adicionar Anúncio </a>
    <?php
    // Exibindo as mensagens de validação do form
    if(!empty($_SESSION['msg'])) {

        foreach($_SESSION['msg'] as $m) {
            echo $m;
        }             
        unset($_SESSION['msg']);
    }
    ?>

    <table class="table table-stripd"> 
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php 
            $myAds = $ad->getMyAds($userInfo['id']);

            foreach($myAds as $item):
        ?>
            <tr>
                <?php if(!empty($item['url'])): ?>
                    <td><img src="assets/images/anuncios/<?=Sanitizer::safeOutput($item['url']);?>" height="50" border="0" /></td>
                <?php else: ?>
                    <td><img src="assets/images/anuncios/default.png" height="50" border="0" /></td>
                <?php endif; ?>
                <td><?= Sanitizer::safeOutput($item['titulo']); ?></td>
                <td>R$ <?= htmlspecialchars(number_format($item['valor'], 2)); ?></td>
                <td>
                    <a href="index.php?page=ad-edit&id=<?=Sanitizer::safeOutput($item['id']);?>" class="btn btn-warning"> Editar</a>
                    <button type="button" 
                            class="btn btn-danger"
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmDeleteModal"
                            data-id="<?= Sanitizer::safeOutput($item['id']); ?>"
                            data-nome="<?= Sanitizer::safeOutput($item['titulo']); ?>"
                            data-action="actions/ad/delete-ad.php"                            
                           >
                        Excluir
                    </button>
                </td>
            </tr>
        <?php 
            endforeach; 
        ?>
    </table>

</div>
