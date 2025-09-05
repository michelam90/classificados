<?php
require_once __DIR__."/../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Classificados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" >
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="http://localhost/classificados/index.php" class="navbar-brand">Classificados</a>
            </div>
            <ul class="navbar-nav navbar-right">
              <?php if( isset($_SESSION['token']) && !empty($_SESSION['token']) ): ?>
                <li class="nav-item"><a class="nav-link" href=""> <?= $userInfo['nome']; ?> </a></li>
            <?php endif; ?>

            <?php if( isset($_SESSION['token']) && !empty($_SESSION['token']) ): ?>
                <li class="nav-item"><a class="btn btn-warning" href="index.php?page=ad-create"> Anunciar agora! </a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=ad-my-ads"> Meus anúncions </a></li>
                <li class="nav-item"><a class="nav-link" href="actions/auth/logout.php"> Sair </a></li>
            <?php else: ?>
                <li class="nav-item"><a class="btn btn-warning" href="index.php?page=auth-login"> Anunciar agora! </a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=auth-login"> Entrar </a></li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>