<?php
    $title = "Fitness Essential - Créer Question";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';

    require_once 'functions.php';

    if(!isAdmin()){
        header('Location: error404.php');
        die();
    }
    require 'header.php';
?>

<a class="btn btn-primary" href="forum.php" role="button">Revenir à la page précedente</a>

    <div class="row d-flex justify-content-center">
        <form action="addNewCategorie.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="categorieName">Nouvelle catégorie : </label>
                <input type="text" class="form-control" name="categorieName" id="categorieName" placeholder="Entrez le nom de la nouvelle catégorie"> <br>
            </div>

            <div class="row my-3">
                <label for="categorieDescription">Description de la catégorie </label>
                <textarea type="text" class="form-control" name="categorieDescription" id="categorieDescription" placeholder="Décrivez la nouvelle catégorie" rows="5"></textarea>
            </div>
            
            <div class="row my-3">
                <label for="categorieOrder">Ordre d'affichage</label>
                <input type="number" class="form-control" name="categorieOrder" id="categorieOrder">
            </div>

            <div class="mb-3">
                <label for="categorieImage" class="form-label">Image de la catégorie</label>
                <input class="form-control" type="file" name="categorieImage" id="categorieImage">
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="createCategorie" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>