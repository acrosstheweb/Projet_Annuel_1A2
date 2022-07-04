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
    Message("createSport");

?>

<div class="row d-flex justify-content-center">
    <div class="col">
        <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminSports.php'?>" role="button">Revenir à la page précedente</a>
    </div>
    <h1 class="aligned-title">Création d'un nouveau sport</h1>
        <form action="../scripts/addNewSport.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <div class="form-group">
                    <label for="sportName">Nom</label>
                    <input type="text" name="sportName" id="sportName" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="sportDescription">Description</label>
                <textarea name="sportDescription" id="sportDescription" class="form-control" required="required"></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="createSport" class="btn btn-primary">Ajouter le sport</button>
            </div>
        </form>
    </div>


<?php
    require '../../../footer.php';