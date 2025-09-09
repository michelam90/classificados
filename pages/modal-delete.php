<?php
// Gerando token contra ataque CSRF_token
$csrfToken = CsrfValidator::generateToken();
?>

<!-- Modal genérico -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o item <b id="modalItemNomeDisplay"></b>?
      </div>
      <div class="modal-footer">

        <form id="deleteForm" method="post">
          <input type="hidden" name="csrf_token" value="<?=$csrfToken;?>">
          <input type="hidden" name="name" id="modalItemNomeInput">
          <input type="hidden" name="id" id="modalItemId">
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
