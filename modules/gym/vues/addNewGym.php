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
    Message("createGym");

    $pdo = database();
                        
    $queryOwner = $pdo->query("SELECT id, firstname, lastname FROM RkU_USER");
    $resultsOwner = $queryOwner->fetchAll();
    
    $queryCity = $pdo->query("SELECT id, name FROM RkU_CITY");
    $resultsCity = $queryCity->fetchAll();

?>

<div class="row d-flex justify-content-center mt-3">
    <div class="col">
        <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminGyms.php'?>" role="button">Revenir à la page précedente</a>
    </div>
    <h1 class="aligned-title">Ajout d'une nouvelle salle</h1>
        <form action="../scripts/gymValidator.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymName">Nom de la salle</label>
                    <input type="text" name="gymName" id="gymName" class="form-control" required="required">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymArea">Surperficie</label>
                    <input type="number" name="gymArea" id="gymArea" class="form-control" required="required">
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymOwner">Directeur</label>
                    <select class="form-select" name="gymOwner" id="gymOwner" required="required"><br>
                        <option value="" selected disabled hidden>Veuillez choisir</option>
                        <?php 
                            foreach($resultsOwner as $owner){
                        ?>
                            <option value="<?= $owner['id'] ?>"> <?= $owner['firstname'] . ' ' . $owner['lastname'] ?> </option>
                        <?php
                            }
                        ?>
                </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymCity">Ville</label>
                    <select class="form-select" name="gymCity" id="gymCity" required="required"><br>
                        <option value="" selected disabled hidden>Veuillez choisir</option>
                        <?php 
                            foreach($resultsCity as $city){
                        ?>
                            <option value="<?= $city['id'] ?>"> <?= $city['name'] ?> </option>
                        <?php
                            }
                        ?>
                </select>
                </div>
            </div>
            
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymAddress">Adresse de la salle</label>
                    <input type="text" name="gymAddress" id="gymAddress" class="form-control" required="required">
                </div>
            </div>

            <div class="row my-3">
                <div class="form-group">
                    <label for="gymPhone">Numéro de téléphone</label>
                    <input type="number" name="gymPhone" id="gymPhone" class="form-control" placeholder="Saisir un numéro de téléphone à 10 chiffres sans espaces" required="required">
                </div>
            </div>
            
            <div class="row my-3">
                <div class="form-group">
                    <label for="gymMap">Recherche Google Maps</label>
                    <input type="text" name="gymMap" id="gymMap" class="form-control" placeholder="Saisir la recherche Google Maps permettant de trouver la salle" required="required">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="createGym" class="btn btn-primary">Ajouter la salle</button>
            </div>
        </form>
    </div>




<?php
    require '../../../footer.php';