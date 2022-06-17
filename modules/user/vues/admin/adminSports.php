<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message("Delete");
Message("modifySport");
Message("createSport");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_SPORT");

$results = $req->fetchAll();

?>

<h1 class="aligned-title">Gestion des sports disponibles</h1>

<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-8">
            <div class="text-end my-3">
                <a href="../../../sport/vues/newSport.php" class="btn btn-primary">Créer un Sport</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="programsTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom du sport</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $sport){
            ?>
                        <tr>
                            <td class="align-middle"><?php echo $sport['id'];?></td>
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
                                        <form id="deleteSport<?= $sport['id'];?>" action="<?= DOMAIN . 'modules/sport/scripts/deleteSport.php?sportId=' . $sport['id']?>" method="POST" >
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
                                        <button class="btn btn-primary delete-passwordConfirm" form="deleteSport<?= $sport['id'];?>" type="submit">Supprimer</button>
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
