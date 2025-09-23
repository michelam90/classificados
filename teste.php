<!-- PARTE 1: Navbar + Offcanvas Sidebar -->
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intranet - Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { padding-top: 70px; background: #f5f7fb; }
    .card-avatar { width: 56px; height: 56px; object-fit: cover; border-radius: 50%; }
    .small-avatar { width: 32px; height: 32px; object-fit: cover; border-radius: 50%; }
    .carousel-inner .carousel-item > img { object-fit: cover; height: 220px; border-radius: .375rem; }
    .badge-day { font-size: .9rem; }
    .quick-links a { display: block; padding: .35rem 0; text-decoration: none; }
    .table-actions > button { margin-right: .25rem; }
    .card-shadow { box-shadow: 0 4px 12px rgba(0,0,0,.08); border-radius: .5rem; }
    .card-header-custom { background: #e9ecef; border-bottom: 1px solid #dee2e6; border-radius: .5rem .5rem 0 0; }
    @media (max-width: 991px) { .carousel-inner .carousel-item > img { height: 180px; } }
  </style>
</head>
<body>
  <!-- Navbar fixa superior -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container-fluid">
      <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand fw-bold" href="#">Minha Intranet</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Departamentos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Documentos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Ajuda</a></li>
        </ul>
        <div class="d-flex align-items-center">
          <div class="me-3 text-end d-none d-md-block">
            <div class="small text-muted">Olá,</div>
            <div class="fw-semibold">Usuário Exemplo</div>
          </div>
          <img src="https://images.unsplash.com/photo-1545996124-1b5a5b4d3b3b?q=80&w=80&auto=format&fit=crop&s=placeholder" alt="avatar" class="small-avatar">
        </div>
      </div>
    </div>
  </nav>

  <!-- Sidebar Offcanvas -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <div class="list-group mb-3">
        <a class="list-group-item list-group-item-action" href="#">Dashboard</a>
        <a class="list-group-item list-group-item-action" href="#users">Usuários</a>
        <a class="list-group-item list-group-item-action" href="#banners">Banners</a>
        <a class="list-group-item list-group-item-action" href="#documentos">Documentos</a>
        <a class="list-group-item list-group-item-action" href="#config">Configurações</a>
      </div>
      <h6 class="mb-2">Configurações</h6>
      <div class="list-group">
        <a class="list-group-item list-group-item-action" href="#">Exibir usuário</a>
        <a class="list-group-item list-group-item-action" href="#">Alterar senha</a>
        <a class="list-group-item list-group-item-action" href="#">Criar usuário</a>
      </div>
      <hr>
      <small class="text-muted">Atalhos</small>
      <div class="d-grid mt-2">
        <button class="btn btn-sm btn-outline-primary">Adicionar banner</button>
      </div>
    </div>
  </div>


  <!-- PARTE 2: Conteúdo principal - Coluna esquerda -->
<main class="container-fluid mt-3">
  <div class="row g-3">
    <!-- Coluna esquerda -->
    <div class="col-12 col-lg-7">
      <div class="row g-3">
        <!-- Carrossel e Cards laterais -->
        <div class="col-12">
          <div class="card card-shadow">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12 col-md-7">
                  <!-- Carousel -->
                  <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1200&auto=format&fit=crop&s=placeholder" class="d-block w-100" alt="banner1">
                      </div>
                      <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=1200&auto=format&fit=crop&s=placeholder" class="d-block w-100" alt="banner2">
                      </div>
                      <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=1200&auto=format&fit=crop&s=placeholder" class="d-block w-100" alt="banner3">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                      <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon"></span>
                      <span class="visually-hidden">Próximo</span>
                    </button>
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <!-- Agendamentos da semana -->
                  <h6>Agendamentos da semana</h6>
                  <div class="list-group mb-3">
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                      <div>
                        <div class="fw-bold">Reunião Financeira</div>
                        <div class="small text-muted">Sala 1 • 10:00</div>
                      </div>
                      <span class="badge bg-primary badge-day">Seg 22</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                      <div>
                        <div class="fw-bold">Treinamento RH</div>
                        <div class="small text-muted">Auditório • 14:00</div>
                      </div>
                      <span class="badge bg-success badge-day">Qua 24</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                      <div>
                        <div class="fw-bold">Apresentação Projeto X</div>
                        <div class="small text-muted">Sala 3 • 16:00</div>
                      </div>
                      <span class="badge bg-warning text-dark badge-day">Sex 26</span>
                    </div>
                  </div>

                  <!-- Aniversariantes do dia e do mês -->
                  <div class="card card-shadow text-center">
                    <div class="card-body">
                      <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop&s=placeholder" class="card-avatar mb-2" alt="aniver">
                      <h6 class="mb-0">João Silva</h6>
                      <small class="text-muted d-block mb-2">Aniversariante do dia</small>
                      <div class="mb-2"><i class="bi bi-balloon-heart-fill fs-4 text-danger"></i></div>
                      <hr>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                          <img src="https://images.unsplash.com/photo-1545996124-1b5a5b4d3b3b?q=80&w=80&auto=format&fit=crop&s=placeholder" class="small-avatar me-2">
                          <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=80&auto=format&fit=crop&s=placeholder" class="small-avatar me-2">
                          <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=80&auto=format&fit=crop&s=placeholder" class="small-avatar me-2">
                        </div>
                        <a href="#" class="small">+ mais</a>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Últimas notícias e parabenizações -->
        <div class="col-12">
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <div class="card card-shadow">
                <div class="card-header card-header-custom">Últimas notícias</div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Nova política de home office <small class="text-muted d-block">12 set 2025</small></li>
                  <li class="list-group-item">Atualização do sistema interno <small class="text-muted d-block">10 set 2025</small></li>
                  <li class="list-group-item">Resultado trimestral divulgado <small class="text-muted d-block">02 set 2025</small></li>
                  <li class="list-group-item">Integração com novo serviço <small class="text-muted d-block">28 ago 2025</small></li>
                </ul>
                <div class="mt-2 text-end pe-3"><a href="#">Ver mais</a></div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="card card-shadow mb-3">
                <div class="card-body d-flex align-items-start gap-3">
                  <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop&s=placeholder" class="card-avatar">
                  <div>
                    <div class="fw-semibold">Parabéns!</div>
                    <div class="small text-muted">Maria Oliveira - 2 anos de empresa</div>
                  </div>
                </div>
              </div>

              <div class="card card-shadow">
                <div class="card-body">
                  <h6>Links rápidos</h6>
                  <div class="quick-links">
                    <a href="#"><i class="bi bi-link-45deg"></i> Portal RH</a>
                    <a href="#"><i class="bi bi-link-45deg"></i> Solicitação de férias</a>
                    <a href="#"><i class="bi bi-link-45deg"></i> Reservas de salas</a>
                    <a href="#"><i class="bi bi-link-45deg"></i> Manual de processos</a>
                    <a href="#"><i class="bi bi-link-45deg"></i> Atendimento TI</a>
                  </div>
                  <div class="mt-2 text-end"><a href="#">Ver mais</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


    <!-- PARTE 3: Conteúdo principal - Coluna direita -->
<div class="col-12 col-lg-5">
  <div class="row g-3">
    <!-- Últimos documentos -->
    <div class="col-12">
      <div class="card card-shadow">
        <div class="card-header card-header-custom">Últimos documentos</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Regulamento Interno.pdf</div>
              <div class="small text-muted">Enviado por: RH • 11 set 2025</div>
            </div>
            <i class="bi bi-file-earmark-text-fill fs-4"></i>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Checklist Segurança.docx</div>
              <div class="small text-muted">Enviado por: Segurança • 09 set 2025</div>
            </div>
            <i class="bi bi-file-earmark-text-fill fs-4"></i>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Política de Viagem.pdf</div>
              <div class="small text-muted">Enviado por: Viagens • 01 set 2025</div>
            </div>
            <i class="bi bi-file-earmark-text-fill fs-4"></i>
          </li>
        </ul>
        <div class="mt-2 text-end pe-3"><a href="#">Ver mais</a></div>
      </div>
    </div>

    <!-- Banners recentes -->
    <div class="col-12">
      <div class="card card-shadow">
        <div class="card-header card-header-custom">Banners recentes</div>
        <table class="table table-sm mb-0">
          <thead>
            <tr>
              <th>Título</th>
              <th>Data</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Banner Inicial</td>
              <td>12 set 2025</td>
              <td class="table-actions text-end">
                <button class="btn btn-sm btn-outline-primary">Editar</button>
                <button class="btn btn-sm btn-outline-danger">Excluir</button>
              </td>
            </tr>
            <tr>
              <td>Promoção Intranet</td>
              <td>05 set 2025</td>
              <td class="table-actions text-end">
                <button class="btn btn-sm btn-outline-primary">Editar</button>
                <button class="btn btn-sm btn-outline-danger">Excluir</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="mt-2 text-end pe-3"><a href="#">Adicionar banner</a></div>
      </div>
    </div>

    <!-- Tabela de usuários -->
    <div class="col-12">
      <div class="card card-shadow">
        <div class="card-header card-header-custom">Usuários</div>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Departamento</th>
                <th>Email</th>
                <th>Ativo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mariana Costa</td>
                <td>Marketing</td>
                <td>mariana@exemplo.com</td>
                <td><span class="badge bg-success">Sim</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-secondary">Editar</button>
                  <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </td>
              </tr>
              <tr>
                <td>João Pereira</td>
                <td>TI</td>
                <td>joao@exemplo.com</td>
                <td><span class="badge bg-success">Sim</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-secondary">Editar</button>
                  <button class="btn btn-sm btn-outline-danger">Excluir</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- PARTE 4: Scripts e fechamento do HTML -->
  </div> <!-- row principal -->
</main>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
