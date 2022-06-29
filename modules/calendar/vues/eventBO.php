<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
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
    Message("modifyEvent");

    $pdo = database();
                        
    $reqSport = $pdo->prepare("SELECT name FROM RkU_SPORT WHERE id=:id");
    $reqSport->execute([
        'id'=>$event['sport']
    ]);
    $sportName = $reqSport->fetch()['name'];

    $querySports = $pdo->query("SELECT id, name FROM RkU_SPORT");
    $sports = $querySports->fetchAll();



    $reqGym = $pdo->prepare("SELECT name FROM RkU_GYMS WHERE id=:id");
    $reqGym->execute([
        'id'=>$event['gym']
    ]);
    $gymName = $reqGym->fetch()['name'];

    
    $queryGyms = $pdo->query("SELECT id, name FROM RkU_GYMS");
    $gyms = $queryGyms->fetchAll();

    ?>


<div class="row d-flex justify-content-center">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminEvents.php'?>" role="button">Revenir à la page précedente</a>
        </div>
    <h1 class="aligned-title">Modification d'un évènement</h1>
    <form action="../scripts/Calendar/EventModification.php?eventId=<?= $event['id'] ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
      <div class="row my-3">
            <div class="form-group">
                <label for="eventName">Titre</label>
                <input type="text" name="eventName" id="eventName" class="form-control" value="<?= $event['name']; ?>">
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventDate">Date</label>
                <input type="date" name="eventDate" id="eventDate" class="form-control" value="<?= (new \DateTime($event['startDate']))->format('Y-m-d'); ?>">
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventPrice">Prix</label>
                <input type="number" name="eventPrice" id="eventPrice" class="form-control" value="<?= $event['price']; ?>">
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventSport">Sport</label>
                <select class="form-select" name="eventSport" id="eventSport"><br>
                    <option default value="<?= $event['sport'] ?>"><?= $sportName ?></option>
                    <?php 
                        foreach($sports as $sport){
                    ?>
                        <option value="<?= $sport['id'] ?>"> <?= $sport['name'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventGym">Salle</label>
                <select class="form-select" name="eventGym" id="eventGym"><br>
                    <option default value="<?= $event['gym'] ?>"><?= $gymName ?></option>
                    <?php 
                        foreach($gyms as $gym){
                    ?>
                        <option value="<?= $gym['id'] ?>"> <?= $gym['name'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventPlaces">Nombre de places</label>
                <input type="number" name="eventPlaces" id="eventPlaces" class="form-control" value="<?= $event['places']; ?>">
            </div>
        </div>
        
        <div class="row my-3">
            <div class="form-group">
                <label for="eventStart">Démarrage</label>
                <input type="time" name="eventStart" id="eventStart" class="form-control" placeholder="HH:MM" value="<?=  (new \DateTime($event['startDate']))->format('H:i'); ?>">
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="eventEnd">Fin</label>
                <input type="time" name="eventEnd" id="eventEnd" class="form-control" placeholder="HH:MM" value="<?=  (new \DateTime($event['endDate']))->format('H:i'); ?>">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="eventDescription">Description</label>
                <textarea name="eventDescription" id="eventDescription" class="form-control"><?= $event['description']; ?></textarea>
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="delete-userPasswordInput" class="fw-bold">Votre mot de passe</label>
                <input id="delete-userPasswordInput" class="form-control" type="password" name="delete-userPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <button class="btn btn-primary delete-passwordConfirm" name="modifyEvent" type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>

<?php
require '../../../footer.php';
?>