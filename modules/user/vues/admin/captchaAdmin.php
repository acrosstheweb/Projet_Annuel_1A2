<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}
$title = "Fitness Essential - Modification Captcha";
$content = "Modification Captcha";

$captchas = glob(ABSOLUTE_PATH . 'sources/captcha/captcha?????????.{jpg,jpeg,png}', GLOB_BRACE);

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
                    <h3>Rajouter une image de captcha</h3>
                    <form method="POST" class="col-10" action="../../scripts/admin/captchaModify.php" enctype="multipart/form-data"> <!-- Le enctype permet de spécifier que les données envoyées lors de l'envoi sont encodées lors de la soumission au serveur. -->
                        <div>
                            <p>Importer une image</p>
                            <input class="form-control" type="file" name="captcha-image" id="__captcha-image" required="required">
                        </div><br><br>

                        <input type="submit" class="btn btn-primary" required="required" name="captcha-images-form" value="Upload">
                    </form>
                </div>

                <div class="col-12 col-md-10 col-lg-6 mt-5 mt-lg-0">
                    <h3>Modifier la ifficulté du captcha</h3>
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

            <div class="row mt-5">
                <div class="col-12 mt-5 mt-lg-0">
                    <h3>Images de captcha déjà présentes</h3>
                    <div class="row d-flex">
                    <?php
                        foreach($captchas as $captcha){
                            $fileName = explode('/', $captcha);
                            $fileName = $fileName[sizeof($fileName)-1];
                    ?>
                            <div class="col">
                                <div class="card bg-dark text-white mx-2 __captchaCard">
                                    <img src="<?= DOMAIN . 'sources/captcha/' . $fileName ?>" class="__captchaPreview img-fluid card-img" alt="captcha image">
                                    <div class="card-img-overlay text-end">
                                        <p class="card-text p-2"><a href="<?= DOMAIN . 'modules/user/scripts/admin/captchaDelete.php?id=' .  $fileName ?>" class="btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a></p>
                                    </div>
                                </div>
                            </div>
                            

                    <?php } ?>
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
