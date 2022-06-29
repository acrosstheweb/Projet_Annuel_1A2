<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }
    $title = "Fitness Essential - Liste des abonnements";
    $content = "Liste des abonnements";

require '../../../../header.php';
Message("Delete");
Message("modifySubscription");
Message("createSubscription");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_SUBSCRIPTION");

$results = $req->fetchAll();

?>

<div class="container-fluid d-lg-none">
    <div class="row __profileDropdown">
        <div class="dropdown d-grid gap-2">
            <button class="btn dropdown-toggle text-light" type="button" id="__profileDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $content ?>
            </button>
            <ul class="dropdown-menu justify-content-center __profileDropdownMenu text-light" aria-labelledby="dropdownMenuButton1">
                <?php include 'adminNavbar.php'; ?>
            </ul>
        </div>
    </div>
</div>

<h1 class="aligned-title">Gestion des abonnements</h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">

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

<?php
include "../../../../footer.php";
?>