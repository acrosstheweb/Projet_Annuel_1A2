<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

require '../../../../header.php';
?>

    <h1 class="aligned-title">Statistiques générales</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none col-2 d-md-flex justify-content-center">
                <?php include "adminNavbar.php"; ?>
            </div>


        </div>
    </div>

<?php
include "../../../../footer.php";
?>