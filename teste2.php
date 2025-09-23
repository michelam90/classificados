<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Intranet - Dashboard Completo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { padding-top: 70px; background: #f5f7fb; }
    .card-shadow { box-shadow: 0 4px 12px rgba(0,0,0,.08); border-radius: .5rem; }
    .card-avatar { width: 56px; height: 56px; object-fit: cover; border-radius: 50%; }
    .small-avatar { width: 32px; height: 32px; object-fit: cover; border-radius: 50%; }
    .carousel-inner .carousel-item > img { object-fit: cover; height: 220px; border-radius: .375rem; }
    .badge-day { font-size: .9rem; }
    .quick-links a { display: block; padding: .35rem 0; text-decoration: none; }
    .card-header-custom { background: #e9ecef; border-bottom: 1px solid #dee2e6; border-radius: .5rem .5rem 0 0; }
    .aniver-name { font-size: 0.9rem; font-weight: 500; margin-top: 4px; }
    @media (max-width: 991px) { .carousel-inner .carousel-item > img { height: 180px; } }
  </style>
</head>
<body>

<!-- Navbar superior -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Intranet</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#">Página Inicial</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Documentos</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Notícias</a></li>
      </ul>
      <div class="d-flex">
        <span class="navbar-text me-3">Olá, Usuário</span>
        <button class="btn btn-outline-primary">Sair</button>
      </div>
    </div>
  </div>
</nav>

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="list-group list-group-flush">
      <a href="#" class="list-group-item list-group-item-action">Configurações</a>
      <a href="#" class="list-group-item list-group-item-action">Usuários</a>
      <a href="#" class="list-group-item list-group-item-action">Banners</a>
      <a href="#" class="list-group-item list-group-item-action">Documentos</a>
      <a href="#" class="list-group-item list-group-item-action">Notícias</a>
    </div>
  </div>
</div>

<main class="container-fluid mt-3">
  <div class="row g-3">
    <!-- Aqui iniciaremos as três colunas: esquerda, central e direita -->

        <!-- Coluna esquerda -->
    <div class="col-12 col-lg-4">
      <!-- Banner -->
      <div class="card card-shadow mb-3">
        <div class="card-body">
          <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1200&auto=format&fit=crop&s=placeholder" class="d-block w-100" alt="banner1">
              </div>
              <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=1200&auto=format&fit=crop&s=placeholder" class="d-block w-100" alt="banner2">
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
      </div>

      <!-- Últimos documentos -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Últimos documentos</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Regulamento Interno.pdf</div>
              <div class="small text-muted">RH • 11 set 2025</div>
            </div>
            <i class="bi bi-file-earmark-text-fill fs-4"></i>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Política de Viagem.pdf</div>
              <div class="small text-muted">Viagens • 01 set 2025</div>
            </div>
            <i class="bi bi-file-earmark-text-fill fs-4"></i>
          </li>
        </ul>
        <div class="mt-2 text-end pe-3">
          <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseDocs" role="button" aria-expanded="false" aria-controls="collapseDocs">Veja mais</a>
        </div>
        <div class="collapse" id="collapseDocs">
          <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">Manual de Conduta.pdf</div>
                <div class="small text-muted">RH • 20 ago 2025</div>
              </div>
              <i class="bi bi-file-earmark-text-fill fs-4"></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">Relatório Anual.pdf</div>
                <div class="small text-muted">Financeiro • 15 jul 2025</div>
              </div>
              <i class="bi bi-file-earmark-text-fill fs-4"></i>
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- Fim da coluna esquerda -->

        <!-- Coluna central -->
    <div class="col-12 col-lg-4">
      <!-- Agenda da semana -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Agendamentos da semana</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <div class="fw-bold">Reunião Financeira</div>
              <div class="small text-muted">Sala 1 • 10:00</div>
            </div>
            <span class="badge bg-primary badge-day">Seg 22</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <div class="fw-bold">Treinamento RH</div>
              <div class="small text-muted">Sala 3 • 14:00</div>
            </div>
            <span class="badge bg-success badge-day">Qua 24</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <div class="fw-bold">Apresentação Projetos</div>
              <div class="small text-muted">Sala 2 • 16:00</div>
            </div>
            <span class="badge bg-warning text-dark badge-day">Sex 26</span>
          </li>
        </ul>
        <div class="mt-2 text-end pe-3">
          <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseAgenda" role="button" aria-expanded="false" aria-controls="collapseAgenda">Veja mais</a>
        </div>
        <div class="collapse" id="collapseAgenda">
          <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-bold">Workshop Marketing</div>
                <div class="small text-muted">Sala 4 • 09:00</div>
              </div>
              <span class="badge bg-info text-dark badge-day">Qui 25</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Últimas notícias -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Últimas notícias</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Nova política interna de home office</li>
          <li class="list-group-item">Integração de novos colaboradores</li>
          <li class="list-group-item">Reforma do refeitório concluída</li>
        </ul>
        <div class="mt-2 text-end pe-3">
          <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseNews" role="button" aria-expanded="false" aria-controls="collapseNews">Veja mais</a>
        </div>
        <div class="collapse" id="collapseNews">
          <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">Atualização do sistema interno de chamados</li>
            <li class="list-group-item">Nova parceria com fornecedores de café</li>
            <li class="list-group-item">Resultado do último trimestre financeiro</li>
          </ul>
        </div>
      </div>
    </div> <!-- Fim da coluna central -->


        <!-- Coluna direita -->
    <div class="col-12 col-lg-4">
      <!-- Aniversariantes do dia/mês -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Aniversariantes</div>
        <div class="card-body text-center">
          <!-- Aniversariante do dia -->
          <img src="https://randomuser.me/api/portraits/women/65.jpg" class="card-avatar mb-2" alt="Aniversariante do dia">
          <div class="aniver-name fw-semibold">Maria Silva</div>
          <i class="bi bi-cup-fill text-warning fs-5"></i>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex align-items-center">
            <img src="https://randomuser.me/api/portraits/men/43.jpg" class="small-avatar me-2" alt="Aniversariante 1">
            João Souza
          </li>
          <li class="list-group-item d-flex align-items-center">
            <img src="https://randomuser.me/api/portraits/women/22.jpg" class="small-avatar me-2" alt="Aniversariante 2">
            Ana Paula
          </li>
          <li class="list-group-item d-flex align-items-center">
            <img src="https://randomuser.me/api/portraits/men/35.jpg" class="small-avatar me-2" alt="Aniversariante 3">
            Carlos Lima
          </li>
        </ul>
        <div class="mt-2 text-center">
          <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseAnivers" role="button" aria-expanded="false" aria-controls="collapseAnivers">Veja mais</a>
        </div>
        <div class="collapse" id="collapseAnivers">
          <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item d-flex align-items-center">
              <img src="https://randomuser.me/api/portraits/women/55.jpg" class="small-avatar me-2" alt="Aniversariante 4">
              Fernanda Costa
            </li>
            <li class="list-group-item d-flex align-items-center">
              <img src="https://randomuser.me/api/portraits/men/28.jpg" class="small-avatar me-2" alt="Aniversariante 5">
              Roberto Alves
            </li>
          </ul>
        </div>
      </div>

      <!-- Parabéns pelo tempo de casa -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Parabéns pelo tempo de casa</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="fw-semibold">Lucas Pereira</div>
            <div class="small text-muted">2 anos de empresa</div>
          </li>
          <li class="list-group-item">
            <div class="fw-semibold">Juliana Mendes</div>
            <div class="small text-muted">5 anos de empresa</div>
          </li>
        </ul>
      </div>

      <!-- Links favoritos -->
      <div class="card card-shadow mb-3">
        <div class="card-header card-header-custom">Links favoritos</div>
        <div class="card-body quick-links">
          <a href="#"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
          <a href="#"><i class="bi bi-file-earmark-text me-2"></i>Documentos</a>
          <a href="#"><i class="bi bi-chat-left-text me-2"></i>Mensagens</a>
          <a href="#"><i class="bi bi-people me-2"></i>Colaboradores</a>
          <a class="text-decoration-none" data-bs-toggle="collapse" href="#collapseLinks" role="button" aria-expanded="false" aria-controls="collapseLinks">Veja mais</a>
          <div class="collapse" id="collapseLinks">
            <a href="#"><i class="bi bi-calendar-event me-2"></i>Calendário</a>
            <a href="#"><i class="bi bi-gear me-2"></i>Configurações</a>
          </div>
        </div>
      </div>
    </div> <!-- Fim da coluna direita -->


      </div> <!-- Fim da row -->
</main>

<!-- Scripts do Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




