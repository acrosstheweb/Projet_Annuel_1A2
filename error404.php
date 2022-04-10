<?php
    $title = "Fitness Essential - Page introuvable";
    $content = "Page introuvable";
    $currentPage = 'error404';
    include 'header.php';
?>

<h2 class="aligned-title mt-5"> Page introuvable </h2>

<div class="container">
    <div class="row __404 align-items-baseline justify-content-center">
        <p class="col-2 text-end"> 4 </p>
        <img src="sources/img/weight-plate.png" alt="" class="__404plate col-2">
        <p class="col-2"> 4 </p>
    </div>

    <div class="row">
        <p class="text-center">Nous somme désolés, cette page est introuvable.<br></p>
    </div>

    <div class="row">
        <button type="button" class="btn __404btn mx-auto btn-outline-primary">Page d'accueil</button>
    </div>
</div>



<?php
    include 'footer.php';
?>