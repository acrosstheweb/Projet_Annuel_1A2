<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message('modifyGym');
Message("Delete");
Message("createGym");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_GYMS");
$results = $req->fetchAll();

?>

<h1 class="aligned-title">Gestion des salles de sport</h1>

<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-8">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/gym/vues/addNewGym.php'?>" class="btn btn-primary">Ajouter une nouvelle salle</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="gymsTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom de la salle</th>
                            <th>Surface</th>
                            <th>Adresse</th>
                            <th>Directeur</th>
                            <th>Ville</th>
                            <th>Téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $gym){
                $reqCity = $pdo->prepare("SELECT name FROM RkU_CITY WHERE id=:id");
                $reqCity->execute([
                    'id'=>$gym['city']
                ]);
                $cityName = $reqCity->fetch()['name'];

                $reqOwner = $pdo->prepare("SELECT firstname, lastname FROM RkU_USER WHERE id=:id");
                $reqOwner->execute([
                    'id'=>$gym['user']
                ]);
                $ownerName = $reqOwner->fetch();
            ?>
                        <tr>
                            <td class="align-middle"><?php echo $gym['id'];?></td>
                            <td class="align-middle"><?php echo $gym['name'];?></td>
                            <td class="align-middle"><?php echo $gym['surfaceArea'];?></td>
                            <td class="align-middle"><?php echo $gym['address'];?></td>
                            <td class="align-middle"><?php echo $ownerName['firstname'];?> <?php echo $ownerName['lastname'];?></td>
                            <td class="align-middle"><?php echo $cityName;?></td>
                            <td class="align-middle"><?php echo $gym['phoneNumber'];?></td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/gym/vues/gymBO.php?gymId=' . $gym['id'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteGym<?= $gym['id'];?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteGym<?= $gym['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression salle de sport</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="deleteGym<?= $gym['id'];?>" action="<?= DOMAIN . 'modules/gym/scripts/gymSuppression.php?gymId=' . $gym['id'];?>" method="POST" >
                                            <div class="deleteFormInfo">
                                                <h5>Vous êtes sur le point de supprimer cette salle :</h5>
                                                <ul>
                                                    <li>Nom : <?= $gym['name'];?></li>
                                                    <li>Nom : <?= $gym['address'];?></li>
                                                    <li>Nom : <?= $cityName;?></li>
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
                                        <button class="btn btn-primary delete-passwordConfirm" form="deleteGym<?= $gym['id'];?>" type="submit">Supprimer</button>
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
