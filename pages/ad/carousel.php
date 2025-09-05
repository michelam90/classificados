<?php
require_once __DIR__."/../../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();
?>
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    <?php foreach($adData['fotos'] as $key => $image) : ?>
        
        <div class="carousel-item <?= ($key==1) ? 'active' : ''; ?>" data-bs-interval="2000">
            <img src="assets/images/anuncios/<?=$image['url'];?>" class="d-block w-100" alt="..." style="max-width: 800px; max-height: 480px;">
        </div>
        
    <?php endforeach; ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"> < </span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"> > </span>
  </button>
</div>