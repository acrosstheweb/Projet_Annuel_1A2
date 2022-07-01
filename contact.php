<?php
$title = "Fitness Essential - Écrivez-nous";
$content = "Création d'un message sur le forum";
$currentPage = 'messae';
require 'header.php';
?>

    <h2 class="aligned-title"> Une question? Contactez-nous </h2>

    <p class="text-center">Votre demande sera traitée dans les plus brefs délais.</p>

    <div class="row d-flex justify-content-center">
        <form action="" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="messageForum">Sélectionnez un sujet : </label>
                <select class="form-select" name="messageForum" id="messageForum"><br>
                    <option selected>Problème inscription/connexion</option>
                    <option value="1">Non réception des FitCoins</option>
                    <option value="2">Codes de réduction</option>
                    <option value="3">Bug général</option>
                    <option value="4">Autre</option>
                </select>
            </div>

            <div class="row my-3">
                <label for="messageSubject">Objet : </label>
                <input class="form-control" type="text" name="messageSubject" id="messageSubject" placeholder="Sujet"><br>
            </div>

            <div class="row my-3">
                <label for="messageDescription">Décrivez-nous votre problème : </label>
                <textarea class="form-control" name="messageDescription" id="messageDescription" placeholder="Message" rows="5"></textarea>
            </div>

            <div class="row my-3">
                <label for="file" class="form-label">Ajoutez une pièce jointe illustrant votre problème</label>
                <input class="form-control" type="file" id="file" name="file">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>

<?php
include 'footer.php';
?>