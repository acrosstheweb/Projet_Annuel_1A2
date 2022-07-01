<?php
    $title = "Fitness Essential - Merci pour votre achat";
    $content = "Merci pour votre achat";
    $currentPage = 'thanksBought';
    require 'header.php';
?>

<h1 class="aligned-title mt-5"> Merci pour votre achat </h1>

<div class="container">
    <div class="row">
        <p class="text-center">Bienvenue parmi nous, nous espérons vous voir bientôt.<br></p>
    </div>

    <div class="row text-center">
        <div class="col">
            <a href="<?= DOMAIN . 'index.php'?>" type="button" class="btn mx-auto btn-outline-primary">Page d'accueil</a>
        </div>
    </div>
</div>



<?php
    include 'footer.php';
?>