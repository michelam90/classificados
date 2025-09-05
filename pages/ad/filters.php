<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();
?>
 
 <form method="GET">

        <div class="mb-3">
            <label for="category" class="form-label">categoria</label>
            <select name="filters[category]" id="category" class="form-select">
                <option value="0">Selecione uma categoria</option>
                <?php foreach($categories->getAll() as $item): ?>
                    <option value="<?= $item['id']; ?>" <?= ($filters['category'] == $item['id']) ? 'selected="selected"' : ''; ?>><?= $item['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

         <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <select name="filters[price]" id="price" class="form-select">
                <option value="0">Selecione uma faixa de preço</option>
                <option value="0 - 50" <?= ($filters['price'] == '0 - 50') ? 'selected="selected"' : ''; ?>>R$ 0 - 50</option>
                <option value="51 - 100" <?= ($filters['price'] == '51 - 100') ? 'selected="selected"' : ''; ?>>R$ 51 - 100</option>
                <option value="101 - 200" <?= ($filters['price'] == '101 - 200') ? 'selected="selected"' : ''; ?>>R$ 101 - 200</option>
                <option value="201 - 500" <?= ($filters['price'] == '201 - 500') ? 'selected="selected"' : ''; ?>>R$ 201 - 500</option>
                <option value="501 - 9000000000000000000000" <?= ($filters['price'] == '501 - 9000000000000000000000') ? 'selected="selected"' : ''; ?>>R$ 500+</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">Estado de conservação</label>
            <select name="filters[state]" id="state" class="form-select">
                <option value="0">Selecione o estado do produto</option>
                <option value="1" <?= ($filters['state'] == '1') ? 'selected="selected"' : ''; ?>>Ruim</option>
                <option value="2" <?= ($filters['state'] == '2') ? 'selected="selected"' : ''; ?>>Bom</option>
                <option value="3" <?= ($filters['state'] == '3') ? 'selected="selected"' : ''; ?>>Ótimo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-info">Buscar</button>
    

</form>