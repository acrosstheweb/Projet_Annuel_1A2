<?php
    $title = "Fitness Essential - Abonnements";
    $content = "Les différents abonnements de Fitness Essential";
    $currentPage = 'subscriptions';
    require '../../../header.php';
    Message('RegisterSuccess');
    Message('Modify');
    Message('addSubscription');
    Message('addFitcoins');

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
            <a href="<?= DOMAIN . 'modules/cart/scripts/addToCart.php?subscriptionId=' . $subscription['id'] ?>" class="card-link btn btn-primary">Ajouter au panier</a>
            <!-- <a href="#" class="card-link">Ici aussi en fait</a> -->
            <?php
                if(isAdmin()){
            ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modifySubscription<?= $subscription['id'];?>" class="btn btn-primary">Modifier</a>
            <?php } ?>
        </div>
    </div>

    <div class="modal fade" id="modifySubscription<?= $subscription['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification de l'abonnement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="manageSubscription<?= $subscription['id'];?>" action="../scripts/manageSubscription.php?idSubscription=<?= $subscription['id'] ?>" enctype ="multipart/form-data" method="POST" >
                        <div class="row deleteFormInfo">
                            <h5>Vous modifiez l'abonnement <?= $subscription['name'];?> </h5>

                            <div class="col-12">
                                <label for="modify-name<?php echo $subscription['name'];?>" class="fw-bold">Titre</label>
                                <input id="modify-name<?php echo $subscription['name'];?>" class="form-control" type="text" name="modify-name" value="<?php echo $subscription['name'];?>">
                            </div>
                            <div class="col-12">
                                <label for="modify-content<?php echo $subscription['content'];?>" class="fw-bold">Contenu</label>
                                <input id="modify-content<?php echo $subscription['content'];?>" class="form-control" type="text" name="modify-content" value="<?php echo $subscription['content'];?>">
                            </div>
                            <div class="col-12">
                                <label for="modify-price<?php echo $subscription['price'];?>" class="fw-bold">Prix</label>
                                <input id="modify-price<?php echo $subscription['price'];?>" class="form-control" type="number" name="modify-price" value="<?php echo $subscription['price'];?>">
                            </div>
                            <div class="col-12">
                                <label for="modify-firstAttribut<?php echo $subscription['firstAttribut'];?>" class="fw-bold">Attribut 1</label>
                                <input id="modify-firstAttribut<?php echo $subscription['firstAttribut'];?>" class="form-control" type="text" name="modify-firstAttribut" value="<?php echo $subscription['firstAttribut'];?>">
                            </div>
                            <div class="col-12">
                                <label for="modify-secondAttribut<?php echo $subscription['secondAttribut'];?>" class="fw-bold">Attribut 2</label>
                                <input id="modify-secondAttribut<?php echo $subscription['secondAttribut'];?>" class="form-control" type="text" name="modify-secondAttribut" value="<?php echo $subscription['secondAttribut'];?>">
                            </div>
                            <div class="col-12">
                                <label for="modify-thirdAttribut<?php echo $subscription['thirdAttribut'];?>" class="fw-bold">Attribut 3</label>
                                <input id="modify-thirdAttribut<?php echo $subscription['thirdAttribut'];?>" class="form-control" type="text" name="modify-thirdAttribut" value="<?php echo $subscription['thirdAttribut'];?>">
                            </div>
                            
                        </div>
                        <div class="row modify-userPassword">
                            <div class="col-12">
                                <label for="modify-adminPasswordInput" class="fw-bold">Votre mot de passe</label>
                                <input id="modify-adminPasswordInput" class="form-control" type="password" name="modify-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary modify-passwordConfirm" form="manageSubscription<?= $subscription['id'];?>" name = "manageSubscription" type="submit">Modifier</button>
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
        <h4 class="aligned-title text-uppercase">
            <?= $packFitcoins['name'] ?>
            <img src="<?= DOMAIN . 'sources/img/' . $packFitcoins['path']?>" alt="" class="img-fluid __subscriptionIcon">
        </h4>
        <div class="card-body">
            <h5 class="card-title"><?= $packFitcoins['price'] ?></h5>
            <p class="card-text"><?= $packFitcoins['content'] ?></p>
        </div>
        <div class="card-body">
            <a href="<?= DOMAIN . 'modules/cart/scripts/addToCart.php?fitcoinsId=' . $packFitcoins['id'] ?>" class="card-link btn btn-primary">Ajouter au panier</a>
        </div>
    </div>

<?php
}
?>

</div>



<?php
    include '../../../footer.php';
?>