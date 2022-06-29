<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }
    $title = "Fitness Essential - Liste des sports";
    $content = "Liste des sports";

require '../../../../header.php';
Message("Delete");
Message("modifySport");
Message("createSport");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_SPORT");

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

<h1 class="aligned-title">Gestion des sports disponibles</h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/sport/vues/newSport.php' ?>" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Créer un Sport</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="programsTable">
                    <thead>
                        <tr>
                            <th>Nom du sport</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($results as $sport){
                        ?>
                            <tr>
                                <td class="align-middle"><?php echo $sport['name'];?></td>
                                <td class="align-middle"><?php echo $sport['description'];?></td>
                                <td class="align-middle">
                                    <a href="<?= DOMAIN . 'modules/sport/vues/manageSport.php?sportId=' . $sport['id'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                    <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteSport<?= $sport['id'];?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteSport<?= $sport['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Suppression évènement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formDeleteSport<?= $sport['id'];?>" action="<?= DOMAIN . 'modules/sport/scripts/deleteSport.php?sportId=' . $sport['id']?>" method="POST" >
                                                <div class="deleteFormInfo">
                                                    <h5>Vous êtes sur le point de supprimer cet évènement :</h5>
                                                    <ul>
                                                        <li>Nom : <?= $sport['name'];?></li>
                                                        <li>Description : <?= $sport['description'];?> fitcoins</li>
                                                        
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
                                            <button class="btn btn-primary delete-passwordConfirm" form="formDeleteSport<?= $sport['id'];?>" type="submit">Supprimer</button>
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