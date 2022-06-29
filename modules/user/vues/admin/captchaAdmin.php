<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

require '../../../../header.php';
Message('captchaModify');
?>

<h1 class="aligned-title">Modifications captcha</h1>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>
        <div class="col-1"></div>
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <h5>Changer l'image de captcha</h5>
                    <div class="row">
                        <form method="POST" class="col-10" action="../../scripts/admin/captchaModify.php" enctype="multipart/form-data"> <!-- Le enctype permet de spécifier que les données envoyées lors de l'envoi sont encodées lors de la soumission au serveur. -->
                            <div>
                                <p>Uploader une image</p>
                                <input class="form-control" type="file" name="captcha-image" id="__captcha-image" required="required">
                            </div><br><br>

                            <input type="submit" class="btn btn-primary" required="required" name="captcha-images-form" value="Upload">
                        </form>
                    </div>
                </div>

                <div class="col-6">
                    <h5>Difficulté du captcha</h5>
                    <div clas="col-2">
                        <form method="POST" class="col-10" action="../../scripts/admin/captchaModify.php">
                            <div clas="col-4">
                                <p>Nombre de pièces du puzzle</p>
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
