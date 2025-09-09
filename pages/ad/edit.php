<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();


if( isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ) {
    
    $id_anuncio = Sanitizer::integer($_GET['id']);
    
} else {
    header("Location: index.php?page=ad-my-ads");
}

// Gerando token contra ataque CSRF_token
$csrfToken = CsrfValidator::generateToken();

// Pegando dados do anuncio
$adData = $ad->getFullAd($id_anuncio);
       
?>

<div class="container">
    <h1>Editar Anúncio</h1>

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
    <form method="POST" action="actions/ad/edit.php" enctype="multipart/form-data">
        
        <input type="hidden" name="id_anuncio" value="<?= htmlspecialchars($id_anuncio);?>">
        <input type="hidden" name="csrf_token" value="<?=Sanitizer::safeOutput($csrfToken);?>">
        
        <div class="form-floating mb-3">
            
            <select name="category" id="category" class="form-control">
                <?php foreach($categories->getAll() as $item): ?>
                    <option value="<?= Sanitizer::safeOutput($item['id']); ?>" <?= ($adData['id_categoria'] == $item['id']) ? 'selected="selected"' : ''; ?>> <?= Sanitizer::safeOutput($item['nome']); ?> </option>
                <?php endforeach; ?>
            </select>
            <label for="floatingInput">Categoria</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="title" class="form-control" value="<?= Sanitizer::safeOutput($adData['titulo']); ?>">            
            <label for="floatingInput">Titulo</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="price" id="price" class="form-control" value="<?= htmlspecialchars($adData['valor']); ?>">            
            <label for="floatingInput">Preço</label>
        </div>
       

        <div class="form-floating mb-3">
            <textarea name="description" class="form-control" style="height: 100px;"><?= Sanitizer::safeOutput($adData['descricao']); ?></textarea> 
            <label for="floatingInput">Descrição</label>      
        </div>

        <div class="form-floating mb-3">
            <select name="state" id="state" class="form-control">
                <option value="1" <?= ($adData['estado'] == '1') ? 'selected="selected"' : ''; ?>>Ruim</option>
                <option value="2" <?= ($adData['estado'] == '2') ? 'selected="selected"' : ''; ?>>Bom</option>
                <option value="3" <?= ($adData['estado'] == '3') ? 'selected="selected"' : ''; ?>>Ótimo</option>
            </select>
            <label for="floatingInput">Estado de conservação</label>  
        </div>
        
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Fotos do anúncio</label>
            <input type="file" class="form-control" id="inputGroupFile01" name="photos[]" multiple>
        </div>
        
        <br/>
        
        <div class="mb-3">
            <div class="card">
                <div class="card-header">
                    Fotos do anúncio
                </div>
                <div class="card-body">
                    <?php foreach($adData['fotos'] as $foto): ?>
                    <div class="foto_item">
                        <img src="assets/images/anuncios/<?= Sanitizer::safeOutput($foto['url']); ?>" class="img-thumbnail" border="0" /><br/>
                        <a href="actions/ad/delete-photo.php?id=<?= htmlspecialchars($foto['id']); ?>&id_anuncio=<?= htmlspecialchars($id_anuncio); ?>" class="btn btn-light">Excluir Imagem </a>
                    </div>
                    <?php endforeach; ?>
                </div><br/>
            </div>     
        </div>   
        
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
    
    
    <br/>

</div>
<?php
require 'pages/footer.php';
?>