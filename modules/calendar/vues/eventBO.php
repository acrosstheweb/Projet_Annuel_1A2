<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
    }
    
    require_once '../scripts/Calendar/Events.php';
    $events = new Calendar\Events();
    
    if(!isset($_GET['id'])){
        header('Location: ../../../error404.php');
        die();
    }

    try {
        $event = $events->find($_GET['id']);
    }
    catch (\Exception $e) {
        header('Location: ../../../error404.php');
        die();
     }

    require '../../../header.php';

    ?>

<h1><?= $event['name']; ?></h1>

<div class="row d-flex justify-content-center">
        <form action="../scripts/Calendar/EventModification.php?eventId=<?= $event['id'] ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventName">Titre</label>
                    <input type="text" name="eventName" id="eventName" class="form-control" required value="<?= $event['name']; ?>">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventDate">Date</label>
                    <input type="date" name="eventDate" id="eventDate" class="form-control" required value="<?= (new \DateTime($event['startDate']))->format('Y-m-d'); ?>">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventPrice">Prix</label>
                    <input type="number" name="eventPrice" id="eventPrice" class="form-control" required value="<?= $event['price']; ?>">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventSport">Sport</label>
                    <input type="number" name="eventSport" id="eventSport" class="form-control" required value="<?= $event['sport']; ?>">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventGym">Salle</label>
                    <input type="number" name="eventGym" id="eventGym" class="form-control" required value="<?= $event['gym']; ?>">
                </div>
            </div>
            
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventStart">Démarrage</label>
                    <input type="time" name="eventStart" id="eventStart" class="form-control" placeholder="HH:MM" required value="<?=  (new \DateTime($event['startDate']))->format('H:i'); ?>">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventEnd">Fin</label>
                    <input type="time" name="eventEnd" id="eventEnd" class="form-control" placeholder="HH:MM" required value="<?=  (new \DateTime($event['endDate']))->format('H:i'); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="eventDescription">Description</label>
                <textarea name="eventDescription" id="eventDescription" class="form-control" required"><?= $event['description']; ?></textarea>
            </div>

            <div class="row">
                <div class="text-center mt-4 col-6">
                    <button type="submit" name="createEvent" class="btn btn-primary">Modifier l'évènement</button>
                </div>
                <div class="text-center mt-4 col-6">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteEvent<?= $event['id'];?>" class="btn btn-primary">Supprimer l'évènement</a>
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="deleteEvent<?= $event['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression évènement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteEvent<?= $event['id'];?>" action="../scripts/Calendar/EventSuppression.php?eventId=<?= $event['id'];?>" method="POST" >
                        <div class="deleteFormInfo">
                            <h5>Vous êtes sur le point de supprimer cet évènement</h5>
                            <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le supprimer?</p>
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
                    <button class="btn btn-primary delete-passwordConfirm" form="deleteEvent<?= $event['id'];?>" type="submit">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

<ul>
    <li>Date : <?= (new \DateTime($event['startDate']))->format('d/m/Y'); ?></li>
    <li>Heure de démarrage : <?=  (new \DateTime($event['startDate']))->format('H:i'); ?></li>
    <li>Heure de fin : <?=  (new \DateTime($event['endDate']))->format('H:i'); ?></li>
    <li>Description : <br>
    <?= $event['description']; ?>
    </li>
</ul>