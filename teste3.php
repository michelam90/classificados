<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intranet - Gestão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { padding-top: 56px; background: #f5f7fb; }
    .card-shadow { box-shadow: 0 4px 12px rgba(0,0,0,.08); border-radius: .5rem; }
    .card-header-custom { background: #e9ecef; border-bottom: 1px solid #dee2e6; border-radius: .5rem .5rem 0 0; }
    .table-actions button { margin-right: 4px; }
  </style>
</head>
<body>

<!-- Navbar superior -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Intranet</a>
    <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
      <i class="bi bi-list"></i> Menu
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <span class="navbar-text me-3">Olá, Usuário</span>
      <button class="btn btn-outline-primary">Sair</button>
    </div>
  </div>
</nav>

<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="list-group list-group-flush">
      <a href="#" class="list-group-item list-group-item-action" onclick="showContent('usuarios')">Usuários</a>
      <a href="#" class="list-group-item list-group-item-action" onclick="showContent('banners')">Banners</a>
    </div>
  </div>
</div>

<!-- Área principal -->
<main class="container-fluid mt-3">
  <div id="content-area">
    <div class="text-center text-muted py-5">Clique no menu à esquerda para começar.</div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showContent(section) {
    const content = document.getElementById('content-area');
    
    if(section === 'usuarios') {
      content.innerHTML = `
        <div class="card card-shadow mb-3">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <span>Usuários Cadastrados</span>
            <button class="btn btn-sm btn-primary" onclick="showForm('usuario')">Novo Usuário</button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Perfil</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Maria Silva</td>
                  <td>maria@empresa.com</td>
                  <td>Administrador</td>
                  <td class="table-actions">
                    <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>João Souza</td>
                  <td>joao@empresa.com</td>
                  <td>Usuário</td>
                  <td class="table-actions">
                    <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      `;
    }

    if(section === 'banners') {
      content.innerHTML = `
        <div class="card card-shadow mb-3">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <span>Banners Cadastrados</span>
            <button class="btn btn-sm btn-primary" onclick="showForm('banner')">Novo Banner</button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Imagem</th>
                  <th>Título</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><img src="https://via.placeholder.com/80x40" class="img-thumbnail"></td>
                  <td>Banner Promocional</td>
                  <td class="table-actions">
                    <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      `;
    }
  }

  function showForm(type) {
    const content = document.getElementById('content-area');
    
    if(type === 'usuario') {
      content.innerHTML = `
        <div class="card card-shadow mb-3">
          <div class="card-header card-header-custom">Cadastrar Usuário</div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Digite o nome">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" placeholder="Digite o e-mail">
              </div>
              <div class="mb-3">
                <label for="perfil" class="form-label">Perfil</label>
                <select class="form-select" id="perfil">
                  <option selected>Selecione o perfil</option>
                  <option value="admin">Administrador</option>
                  <option value="user">Usuário</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
          </div>
        </div>
      `;
    }

    if(type === 'banner') {
      content.innerHTML = `
        <div class="card card-shadow mb-3">
          <div class="card-header card-header-custom">Cadastrar Banner</div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" placeholder="Digite o título">
              </div>
              <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem">
              </div>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
          </div>
        </div>
      `;
    }
  }
</script>

</body>
</html>
