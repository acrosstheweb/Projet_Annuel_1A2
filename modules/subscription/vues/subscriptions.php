<?php
    $title = "Fitness Essential - Abonnements";
    $content = "Les différents abonnements de Fitness Essential";
    $currentPage = 'subscriptions';
    require '../../../header.php';
    Message('RegisterSuccess');

    $pdo = database();

    $request = $pdo->query("SELECT * FROM RkU_SUBSCRIPTION");
    $results = $request->fetchAll();

?>

<h1 class="aligned-title"> Choisissez votre abonnement </h1>

<div class="row justify-content-center">
<?php
foreach($results as $subscription){
?>

    <div class="card col-10 col-md-5 col-lg-3 __subscriptionCard">
        <h4 class="aligned-title text-uppercase">
            <?= $subscription['name'] ?>
            <img src="<?= DOMAIN . 'sources/img/' . $subscription['path']?>" alt="" class="img-fluid __subscriptionIcon">
        </h4>
        <div class="card-body">
            <h5 class="card-title"><?= $subscription['price'] ?>€/mois</h5>
            <p class="card-text"><?= $subscription['content'] ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?= $subscription['firstAttribut'] ?></li>
            <li class="list-group-item"><?= $subscription['secondAttribut'] ?></li>
            <li class="list-group-item"><?= $subscription['thirdAttribut'] ?></li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">Achète ici</a>
            <a href="#" class="card-link">Ici aussi en fait</a>
        </div>
    </div>

<?php
}
?>







<!-- 
    <div class="card col-10 col-md-5 col-lg-3 __subscriptionCard">
        <h4 class="aligned-title text-uppercase">
            Classic
            <img src="<?= DOMAIN . 'sources/img/classic.png'?>" alt="" class="img-fluid __subscriptionIcon">
        </h4>
        <div class="card-body">
            <h5 class="card-title">23,99€/Mois</h5>
            <p class="card-text">Accès classique à la salle de sport. Catégorie socioprofessionnelle moyenne, tu ne mérites pas que je t'embête</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Fonctionnaire</li>
            <li class="list-group-item">Abonnement rentabilisé</li>
            <li class="list-group-item">+ Regard des autres</li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">Achète ici</a>
            <a href="#" class="card-link">Ici aussi en fait</a>
        </div>
    </div>

    <div class="card col-10 col-md-5 col-lg-3 __subscriptionCard">
        <h4 class="aligned-title text-uppercase">
            Premium
            <img src="<?= DOMAIN . 'sources/img/premium.png'?>" alt="" class="img-fluid __subscriptionIcon">
        </h4>
        <div class="card-body">
            <h5 class="card-title">49,99€/Mois</h5>
            <p class="card-text">Wow, tu possèdes un maximum de valeur financière, ce qui te permet donc de profiter sur système capitaliste comme bon te semble.</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Pesos Mexicanos</li>
            <li class="list-group-item">Livres Sterling</li>
            <li class="list-group-item">Dinar Algérien</li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">Achète ici</a>
            <a href="#" class="card-link">Ici aussi en fait</a>
        </div>
    </div>
</div> -->

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


<?php
    include '../../../footer.php';
?>