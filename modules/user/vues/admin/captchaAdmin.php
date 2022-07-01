<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}
$title = "Fitness Essential - Modification Captcha";
$content = "Modification Captcha";

require '../../../../header.php';
Message('captchaModify');
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

<h1 class="aligned-title">Modifications captcha</h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            <div class="row justify-content-evenly">
                <div class="col-12 col-md-10 col-lg-6">
                    <h5>Rajouter une image de captcha</h5>
                    <form method="POST" class="col-10" action="../../scripts/admin/captchaModify.php" enctype="multipart/form-data"> <!-- Le enctype permet de spécifier que les données envoyées lors de l'envoi sont encodées lors de la soumission au serveur. -->
                        <div>
                            <p>Importer une image</p>
                            <input class="form-control" type="file" name="captcha-image" id="__captcha-image" required="required">
                        </div><br><br>

                        <input type="submit" class="btn btn-primary" required="required" name="captcha-images-form" value="Upload">
                    </form>
                </div>

                <div class="col-12 col-md-10 col-lg-6 mt-5 mt-lg-0">
                    <h5>Modifier la ifficulté du captcha</h5>
                    <div clas="col-2">
                        <form method="POST" class="col-10" action="../../scripts/admin/captchaModify.php">
                            <div clas="col-4">
                                <p>Nombre de pièces dans le puzzle</p>
                                <input class="form-control" type="number" name="captcha-pieces" id="__captcha-pieces" required="required">
                            </div><br><br>
                            <input type="submit" class="btn btn-primary" required="required" name="captcha-pieces-form" value="Envoyer">
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
include "../../../../footer.php";
?>

<script src="<?= DOMAIN . 'js/admin-users.js'?>" crossorigin="anonymous"></script>
