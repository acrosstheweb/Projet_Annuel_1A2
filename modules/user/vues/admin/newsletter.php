<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

require '../../../../header.php';
Message('FormNewsletter');
?>

<h1 class="aligned-title">Envoi d'une newsletter</h1>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-2"></div>
        <form method="POST" class="col-4" action="../../scripts/admin/sendNewsletter.php" id="__newsletterForm">
            <div>
                <label for="__titre-mail">Titre</label>
                <input class="form-control" type="text" id="__titre-mail" name="titre-mail" placeholder="Titre du mail" required="required">
            </div><br><br>

            <p>Destinataires</p>
            <div class="form-check">
                <label class="form-check-label" for="__checkbox-all-users">Tout les utilisateurs</label>
                <input class="form-check-input" type="radio" value="everyone" id="__checkbox-all-users" name="destination" required="required"><br>

                <label class="form-check-label" for="__checkbox-customers">Clients</label>
                <input class="form-check-input" type="radio" value="customers" id="__checkbox-customers" name="destination"><br>

                <label class="form-check-label" for="__checkbox-coachs">Coachs</label>
                <input class="form-check-input" type="radio" value="coachs" id="__checkbox-coachs" name="destination"><br>

                <label class="form-check-label" for="__checkbox-gym-owners">Gérants de salle</label>
                <input class="form-check-input" type="radio" value="owners" id="__checkbox-gym-owners" name="destination"><br>

                <label class="form-check-label" for="__checkbox-admins">Administrateurs</label>
                <input class="form-check-input" type="radio" value="admins" id="__checkbox-admins" name="destination"><br>
            </div><br><br>

            <div>
                <label for="__content-mail">Contenu</label>
                <textarea class="form-control" rows="10" cols="75" id="__content-mail" name="content-mail" required="required"></textarea>
            </div><br><br>

            <input type="submit" required="required" value="Envoyer">
        </form>

    </div>
</div>

<script src="<?= DOMAIN . 'js/checkboxRequired.js'?>"></script>

<?php
include "../../../../footer.php";
?>