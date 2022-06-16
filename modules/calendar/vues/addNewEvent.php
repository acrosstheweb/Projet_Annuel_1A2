<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';
    require '../../../header.php';
    Message("createEvent");

?>

<div class="row d-flex justify-content-center">
        <form action="../scripts/Calendar/EventValidator.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventName">Titre</label>
                    <input type="text" name="eventName" id="eventName" class="form-control" required">
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
                    <input type="number" name="eventSport" id="eventSport" class="form-control" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="eventGym">Salle</label>
                    <input type="number" name="eventGym" id="eventGym" class="form-control" required>
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

            <div class="form-group">
                <label for="eventDescription">Description</label>
                <textarea name="eventDescription" id="eventDescription" class="form-control" required"></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="createEvent" class="btn btn-primary">Ajouter l'évènement</button>
            </div>
        </form>
    </div>




<?php
    require '../../../footer.php';
?>