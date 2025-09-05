<?php
require_once __DIR__."/../helpers/PageAccessValidate.php";
PageAccessValidate::checkPageAccess();
?>
<?php
// filters
$filters = [
    'category' => '',
    'price' => '',
    'state' => ''
];

if(isset($_GET['filters']) && !empty($_GET['filters'])) {
    $filters = filter_input(INPUT_GET, 'filters', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
}

$totalAds = $ad->getTotalAds($filters);
$totalUsers = $user->getTotalUsers();
// Paginação
$currentPage = 1;
if( isset($_GET['p']) && !empty($_GET['p'])) {
    if(is_numeric($_GET['p'])) {
        $currentPage = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
    }
}
$perPage = 2;
$totalPaginas = ceil($totalAds / $perPage);

$ultimosAnuncios = $ad->getLastAds($currentPage, $perPage, $filters);
?>
<br>
    <div class="container-fluid">
        <div class="bg-light rounded-3"> 
            <h2> Nós temos nesse momento <?= $totalAds; ?> anúcions. </h2>
            <p>E mais de <?= $totalUsers; ?> usuários cadastrados.</p>
        </div>
        
        <div class="row">
            <div class="col-sm-3"> 
                <h4> Pesquisa avançada </h4> 
                <?php require 'pages/ad/filters.php'; ?>
            </div>
            <div class="col-sm-9"> 
                <h4> Últimos anúncios </h4> 
                <table class="table table-striped">
                    <tbody>
                        <?php foreach($ultimosAnuncios as $item): ?>
                        <tr>
                            <td>
                            <?php if(!empty($item['url'])): ?>
                                <img src="assets/images/anuncios/<?=$item['url'];?>" height="50" border="0" />
                            <?php else: ?>
                                <img src="assets/images/anuncios/default.png" height="50" border="0" />
                            <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?page=ad-product&id=<?= $item['id']; ?>"> <?= $item['titulo']; ?> </a><br/>
                                <?= $item['categoria']; ?>
                            </td>
                            <td>R$ <?= number_format($item['valor'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <ul class="pagination">
                    <?php for($i=1;$i<=$totalPaginas;$i++): 
                        $url = $_GET;
                        $url['page'] = 'home';
                        $url['p'] = $i;
                        ?>
                        <li class="page-item <?= ($currentPage == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?<?php echo http_build_query($url);?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>

            </div>
        </div>

    </div>