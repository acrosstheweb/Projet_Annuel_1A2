<?php
    header("HTTP/1.0 404 Not Found");
    $title = "Fitness Essential - Page introuvable";
    $content = "Page introuvable";
    $currentPage = 'error404';
    require 'header.php';
    Message('RegisterHack');
    Message('ConfirmRegistration');
    Message('UpdateHack');
    Message('UpdateSecHack');
    Message('DeleteUser');
?>

<h2 class="aligned-title mt-5"> Page introuvable </h2>

<div class="container">
    <div class="row justify-content-center">
        <img src="<?= DOMAIN . 'sources/img/404.png'?>" alt="" class="col-6">
    </div>

    <div class="row">
        <p class="text-center">Nous sommes désolés, cette page est introuvable.<br></p>
    </div>

    <div class="row">
        <a href="<?= DOMAIN . 'index.php'?>" type="button" class="btn __404btn mx-auto btn-outline-primary">Page d'accueil</a>
    </div>
</div>



<?php
    include 'footer.php';
?>