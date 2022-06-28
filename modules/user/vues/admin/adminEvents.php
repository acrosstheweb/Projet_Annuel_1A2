<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message('modifyEvent');
Message("Delete");
Message("createEvent");

$pdo = database();

$req = $pdo->query("SELECT * FROM RkU_BOOKING");
$results = $req->fetchAll();

?>

<h1 class="aligned-title">Gestion des évènements</h1>

<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-8">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/calendar/vues/addNewEvent.php'?>" class="btn btn-primary">Créer un évènement</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="eventsTable">
                    <thead>
                        <tr>
                            <th>Nom de l'évènement</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th class="d-none d-lg-table-cell">Description de l'évènement</th>
                            <th>Prix</th>
                            <th>Sport</th>
                            <th>Gym</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $event){
                $reqSport = $pdo->prepare("SELECT name FROM RkU_SPORT WHERE id=:id");
                $reqSport->execute([
                    'id'=>$event['sport']
                ]);
                $sportName = $reqSport->fetch()['name'];

                $reqGym = $pdo->prepare("SELECT name FROM RkU_GYMS WHERE id=:id");
                $reqGym->execute([
                    'id'=>$event['gym']
                ]);
                $GymName = $reqGym->fetch()['name'];
            ?>
                        <tr>
                            <td class="align-middle"><?php echo $event['name'];?></td>
                            <td class="align-middle"><?php echo $event['startDate'];?></td>
                            <td class="align-middle"><?php echo $event['endDate'];?></td>
                            <td class="align-middle"><?php echo $event['description'];?></td>
                            <td class="align-middle"><?php echo $event['price'];?></td>
                            <td class="align-middle"><?php echo $sportName;?></td>
                            <td class="align-middle"><?php echo $GymName;?></td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/calendar/vues/eventBO.php?id=' . $event['id'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteEvent<?= $event['id'];?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteEvent<?= $event['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression évènement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formDeleteEvent<?= $event['id'];?>" action="<?= DOMAIN . 'modules/calendar/scripts/Calendar/EventSuppression.php?eventId=' . $event['id'];?>" method="POST" >
                                            <div class="deleteFormInfo">
                                                <h5>Vous êtes sur le point de supprimer cet évènement :</h5>
                                                <ul>
                                                    <li>Nom : <?= $event['name'];?></li>
                                                    <li>Date de début : Le <?= (new \DateTime($event['startDate']))->format('d/m/Y'); ?> à <?= (new \DateTime($event['startDate']))->format('H:i'); ?></li>
                                                    <li>Date de début : Le <?= (new \DateTime($event['endDate']))->format('d/m/Y'); ?> à <?= (new \DateTime($event['endDate']))->format('H:i'); ?></li>
                                                    <li>Prix : <?= $event['price'];?> fitcoins</li>
                                                    
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
                                        <button class="btn btn-primary delete-passwordConfirm" form="formDeleteEvent<?= $event['id'];?>" type="submit">Supprimer</button>
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
