<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';
    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
    }
    require '../../../header.php';
    Message("createEvent");

    $pdo = database();
                        
    $querySport = $pdo->query("SELECT id, name FROM RkU_SPORT");
    $resultsSport = $querySport->fetchAll();
    
    $queryGym = $pdo->query("SELECT id, name FROM RkU_GYMS");
    $resultsGym = $queryGym->fetchAll();

?>

<div class="row d-flex justify-content-center">
    <div class="col">
        <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminEvents.php'?>" role="button">Revenir à la page précedente</a>
    </div>
    <h1 class="aligned-title">Création d'un nouvel évènement</h1>
        <form action="../scripts/Calendar/EventValidator.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventName">Titre</label>
                    <input type="text" name="eventName" id="eventName" class="form-control" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventDate">Date</label>
                    <input type="date" name="eventDate" id="eventDate" class="form-control" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventPrice">Prix</label>
                    <input type="number" name="eventPrice" id="eventPrice" class="form-control" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventSport">Sport</label>
                    <select class="form-select" name="eventSport" id="eventSport"><br>
                        <option default value="0">CHOISIR</option>
                        <?php 
                            foreach($resultsSport as $sport){
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
                        <option default value="0">CHOISIR</option>
                        <?php 
                            foreach($resultsGym as $gym){
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
                    <label for="eventStart">Démarrage</label>
                    <input type="time" name="eventStart" id="eventStart" class="form-control" placeholder="HH:MM" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventEnd">Fin</label>
                    <input type="time" name="eventEnd" id="eventEnd" class="form-control" placeholder="HH:MM" required>
                </div>
            </div>

            <div class="row my-3">
                <div class="form-group">
                    <label for="eventDescription">Description</label>
                    <textarea name="eventDescription" id="eventDescription" class="form-control" required"></textarea>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventPlaces">Nombre de places</label>
                    <input type="number" name="eventPlaces" id="eventPlaces" class="form-control" value="<?= $event['places']; ?>">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="createEvent" class="btn btn-primary">Ajouter l'évènement</button>
            </div>
        </form>
    </div>




<?php
    require '../../../footer.php';
?>