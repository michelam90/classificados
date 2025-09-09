document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirmDeleteModal');
    modal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const itemId = button.getAttribute('data-id');
        const itemNome = button.getAttribute('data-nome');
        const action = button.getAttribute('data-action');

        const form = document.getElementById('deleteForm');
        form.action = action;
        document.getElementById('modalItemId').value = itemId;
        document.getElementById('modalItemNomeInput').value = itemNome;
        document.getElementById('modalItemNomeDisplay').textContent = itemNome;
    });
});
