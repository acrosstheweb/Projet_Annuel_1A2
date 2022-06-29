<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message("Delete");
Message("modifySubscription");
Message("createSubscription");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_SUBSCRIPTION");

$results = $req->fetchAll();

?>

<h1 class="aligned-title">Gestion des abonnements</h1>

<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-8">

            <div class="table-responsive">
                <table class="table" id="subscriptionTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom de l'abonnement</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $subscription){
            ?>
                        <tr>
                            <td class="align-middle"><?= $subscription['id'];?></td>
                            <td class="align-middle"><?= $subscription['name'];?></td>
                            <td class="align-middle"><?= $subscription['content'];?></td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/subscription/vues/subscriptionBO.php?subscriptionId=' . $subscription['id'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                            </td>
                        </tr>

            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
