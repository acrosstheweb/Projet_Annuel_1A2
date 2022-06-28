<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

require '../../../../header.php';

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
                        <form method="POST" class="col-10" action="../../scripts/admin/sendNewsletter.php" id="__newsletterForm" enctype ="multipart/form-data"> <!-- Le enctype permet de spécifier que les données envoyées lors de l'envoi sont encodées lors de la soumission au serveur. -->
                            <div>
                                <p>Uploader une image</p>
                                <input class="form-control" type="file" name="content-mail" id="__content-mail" required="required">
                            </div><br><br>

                            <input type="submit" required="required" value="Envoyer">
                        </form>
                    </div>
                </div>

                <div class="col-6">
                    <h5>Difficulté du captcha</h5>
                    <div clas="col-2">
                        <div class="__rectangleStat" id="__newsletterSub"></div>
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
