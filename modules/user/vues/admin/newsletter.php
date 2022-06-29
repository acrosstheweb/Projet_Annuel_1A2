<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}
$title = "Fitness Essential - Gestion de la Newsletter";
$content = "Gestion de la Newsletter";
$currentPage = 'adminNewsletter';

require '../../../../header.php';
Message('FormNewsletter');
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

<h1 class="aligned-title">Envoi d'une newsletter</h1>
<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center">
            <div class="col-10 col- p-3">
                <form method="POST" action="../../scripts/admin/sendNewsletter.php" id="__newsletterForm" enctype ="multipart/form-data"> <!-- Le enctype permet de spécifier que les données envoyées lors de l'envoi sont encodées lors de la soumission au serveur. -->
                    <div>
                        <label class="fw-bold text-uppercase" for="__titre-mail">Titre</label>
                        <input class="form-control" type="text" id="__titre-mail" name="titre-mail" placeholder="Titre du mail" required="required">
                    </div>

                    <label class="fw-bold text-uppercase mt-5" for="__checkbox-mail">Destinataires</label>
                    <div class="form-check">
                        <label class="form-check-label" for="__checkbox-all-users">Tous les utilisateurs</label>
                        <input class="form-check-input" type="radio" value="everyone" id="__checkbox-all-users" name="destination" required="required">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="__checkbox-customers">Clients</label>
                        <input class="form-check-input" type="radio" value="customers" id="__checkbox-customers" name="destination">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="__checkbox-coachs">Coachs</label>
                        <input class="form-check-input" type="radio" value="coachs" id="__checkbox-coachs" name="destination">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="__checkbox-gym-owners">Gérants de salle</label>
                        <input class="form-check-input" type="radio" value="owners" id="__checkbox-gym-owners" name="destination">
                    </div>

                    <div class="form-check">
                        <label class="form-check-label" for="__checkbox-admins">Administrateurs</label>
                        <input class="form-check-input" type="radio" value="admins" id="__checkbox-admins" name="destination">
                    </div>

                    <div>
                        <label class="fw-bold text-uppercase mt-5" for="__content-mail">Contenu du mail</label>
                        <input class="form-control" type="file" name="content-mail" id="__content-mail" required="required">
                    </div>

                    <div class="text-center">
                        <input class="btn btn-primary mt-5" type="submit" required="required" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "../../../../footer.php";
?>