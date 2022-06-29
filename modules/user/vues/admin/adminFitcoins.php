<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }
    $title = "Fitness Essential - Liste des pack FitCoins";
    $content = "Liste des pack FitCoins";

require '../../../../header.php';
Message('modifyPack');
Message("Delete");
Message("createPack");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_FITCOINS");
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

<h1 class="aligned-title">Gestion des packs de FitCoins</h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/subscription/vues/addNewPack.php'?>" class="btn btn-primary">Ajouter un nouveau pack</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="packsTable">
                    <thead>
                        <tr>
                            <th>Nom du pack</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Nombre de FitCoins</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $pack){
            ?>
                        <tr>
                            <td class="align-middle"><?php echo $pack['name'];?></td>
                            <td class="align-middle"><?php echo $pack['description'];?></td>
                            <td class="align-middle"><?php echo $pack['price'];?></td>
                            <td class="align-middle"><?php echo $pack['numberOfFitcoins'];?></td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/subscription/vues/packBO.php?packId=' . $pack['id'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#deletePack<?= $pack['id'];?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="deletePack<?= $pack['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression pack</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="deletePack<?= $pack['id'];?>" action="<?= DOMAIN . 'modules/subscription/scripts/packSuppression.php?packId=' . $pack['id'];?>" method="POST" >
                                            <div class="deleteFormInfo">
                                                <h5>Vous êtes sur le point de supprimer cette salle :</h5>
                                                <ul>
                                                    <li>Nom : <?= $pack['name'];?></li>
                                                    <li>Description : <?= $pack['description'];?></li>
                                                    <li>Prix : <?= $pack['price'];?></li>
                                                    <li>Nombre de fitcoins : <?= $pack['numberOfFitcoins'];?></li>
                                                </ul>
                                            </div>
                                                <div class="row delete-userPassword">
                                                <div class="col">
                                                    <label for="delete-userPasswordInput" class="fw-bold">Votre mot de passe</label>
                                                    <input id="delete-userPasswordInput" class="form-control" type="password" name="delete-userPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button class="btn btn-primary delete-passwordConfirm" form="deletePack<?= $pack['id'];?>" type="submit">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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