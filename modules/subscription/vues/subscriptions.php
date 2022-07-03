<?php
    $title = "Fitness Essential - Abonnements";
    $content = "Les différents abonnements de Fitness Essential";
    $currentPage = 'subscriptions';
    require '../../../header.php';
    Message('RegisterSuccess');
    Message('Modify');
    Message('addSubscription');
    Message('addFitcoins');
    Message("inscriptionEvent");

    $pdo = database();

    $requestSubscription = $pdo->query("SELECT * FROM RkU_SUBSCRIPTION");
    $resultsSubscription = $requestSubscription->fetchAll();
    
    $requestFitcoins = $pdo->query("SELECT * FROM RkU_FITCOINS");
    $resultsFitcoins = $requestFitcoins->fetchAll();
?>

<h1 class="aligned-title"> Choisissez votre abonnement </h1>

<div class="row justify-content-center">
<?php
foreach($resultsSubscription as $subscription){
?>

    <div class="card col-10 col-md-5 col-lg-3 __subscriptionCard">
        <h4 class="aligned-title text-uppercase card-title mt-3">
            <?= $subscription['name'] ?>
            <img src="<?= DOMAIN . 'sources/img/' . $subscription['path']?>" alt="" class="img-fluid __subscriptionIcon">
        </h4>
        <div class="card-body">
            <p class="card-text __subscriptionDescription"><?= $subscription['content'] ?></p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= $subscription['firstAttribut'] ?></li>
                <li class="list-group-item"><?= $subscription['secondAttribut'] ?></li>
                <li class="list-group-item"><?= $subscription['thirdAttribut'] ?></li>
            </ul>
            <div class="row mt-3 d-flex align-items-center">
                <div class="col-6">
                    <p class="fw-bold mb-0"><?= $subscription['price'] ?>€/mois</p>
                </div>
                <div class="col-6 text-end">
                    <a href="<?= DOMAIN . 'modules/cart/scripts/addToCart.php?subscriptionId=' . $subscription['id'] ?>" class="card-link btn btn-primary">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="d-none d-lg-inline">Ajouter au panier</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>

</div>


<div class="row d-flex justify-content-center">
    <div class="col-10 col-lg-8 __subscriptionTableScroll">
        <table class="table table-striped text-center __subscriptionTable">
        <thead>
            <tr class="d-md-none">
                <th scope="col" class="__subscriptionHead"></th>
                <th scope="col">
                    <img src="<?= DOMAIN . 'sources/img/essential.png'?>" alt="" class="img-fluid">
                </th>
                <th scope="col">
                    <img src="<?= DOMAIN . 'sources/img/classic.png'?>" alt="" class="img-fluid">
                </th>
                <th scope="col">
                    <img src="<?= DOMAIN . 'sources/img/premium.png'?>" alt="" class="img-fluid">
                </th>
            </tr>
            <tr class="d-none d-md-table-row">
                <th scope="col" class="__subscriptionHead"></th>
                <th scope="col" class="text-uppercase">Essential</th>
                <th scope="col" class="text-uppercase">Classic</th>
                <th scope="col" class="text-uppercase">Premium</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="text-start __subscriptionHead" scope="row">Accès à toutes les salles Fitness Essential</th>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">Gourde isotherme en métal offerte</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">10 fitcoins crédités par mois</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">Partage de la carte de membre avec une personne résidant à la même adresse</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">1 snack protéiné offert par séance</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>

            <tr>
                <th class="text-start __subscriptionHead" scope="row">Inviter une personne pour s'entraîner avec vous</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>

            <tr>
                <th class="text-start __subscriptionHead" scope="row">1 séance collective offerte par mois</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">1 boisson énergisante offerte par séance</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
            
            <tr>
                <th class="text-start __subscriptionHead" scope="row">Jaaj</th>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-xmark"></i></td>
                <td><i class="fa-solid fa-check"></i></td>
            </tr>
        </tbody>
        </table>
    </div>
    
</div>


<div class="row justify-content-center">
<?php
foreach($resultsFitcoins as $packFitcoins){
?>

    <div class="card col-10 col-md-5 col-lg-3 __subscriptionCard">
        <h4 class="text-uppercase d-flex align-items-center justify-content-center mt-3">
            <?= $packFitcoins['name'] ?>
            <img src="<?= DOMAIN . 'sources/img/fitcoin.svg' ?>" class="img-fluid m-1 p-1 __subscriptionIcon" alt="image de l'abonnement">
        </h4>
        <div class="card-body">
            <p class="card-text"><?= $packFitcoins['description'] ?></p>
            
            <div class="row mt-3 d-flex align-items-center">
                <div class="col-6">
                    <p class="fw-bold mb-0"><?= $packFitcoins['price'] ?>€</p>
                </div>
                <div class="col-6 text-end">
                    <a href="<?= DOMAIN . 'modules/cart/scripts/addToCart.php?fitcoinsId=' . $packFitcoins['id'] ?>" class="card-link btn btn-primary">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="d-none d-lg-inline">Ajouter au panier</span>
                    </a>
                </div>
            </div>
            
        </div>
    </div>

<?php
}
?>

</div>



<?php
    include '../../../footer.php';
?>