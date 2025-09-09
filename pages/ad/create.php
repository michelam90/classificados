<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();

// Gerando token contra ataque CSRF_token
$csrfToken = CsrfValidator::generateToken();

?>
<div class="container">
    <h1>Adicionar Anúncios</h1>

    <?php
    // Exibindo as mensagens de validação do form
    if(!empty($_SESSION['msg'])) {

        foreach($_SESSION['msg'] as $m) {
            echo $m;
        }             
        unset($_SESSION['msg']);
    }
    ?>
    <br/>
    <form method="POST" action="actions/ad/create.php" enctype="multipart/form-data">

        <input type="hidden" name="csrf_token" value="<?=$csrfToken;?>">
       
        <div class="form-floating mb-3">
            <select name="category" id="category" class="form-select" required>
                <?php foreach($categories->getAll() as $item): ?>
                    <option value="<?= Sanitizer::safeOutput($item['id']); ?>"><?= Sanitizer::safeOutput($item['nome']); ?></option>
                <?php endforeach; ?>
            </select>
            <label for="floatingInput">Categoria</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="title" class="form-control" required>
            <label for="floatingInput">Titulo</label>          
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="price" id="price" class="form-control" required>
            <label for="floatingInput">Preço</label>
        </div>
       

        <div class="form-floating mb-3">
            <textarea name="description" class="form-control" style="height: 100px;" required></textarea>
            <label for="floatingInput">Descrição</label>  
        </div>

        <div class="form-floating mb-3">
            <select name="state" id="state" class="form-select" required>
                <option value="1">Ruim</option>
                <option value="2">Bom</option>
                <option value="3">Ótimo</option>
            </select>
            <label for="floatingInput">Estado de conservação</label>    
        </div>
       
        
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

    

</div>
<?php
require 'pages/footer.php';
?>