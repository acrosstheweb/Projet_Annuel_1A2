<?php
    $title = "Fitness Essential - Accès non autorisé";
    $content = "Accès non autorisé";
    $currentPage = 'pleaseLogin';
    require 'header.php';
?>

<h1 class="aligned-title mt-5"> Accès refusé </h1>

<div class="container">
    <div class="row">
        <p class="text-center">Cette page est réservée aux membres de Fitness Essential. Pour y accéder, veuillez 
            <button type="button" class="btn btn-link p-0 align-baseline" data-bs-toggle="modal" data-bs-target="#login-modal">
                vous connecter
            </button>
            .<br>
        </p>
    </div>

    <div class="row text-center mt-3">
        <div class="col">
            <p>Vous n'avez pas encore de compte? </p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#register-modal">
                S'inscrire
            </button>
        </div>
    </div>
</div>



<?php
    include 'footer.php';
?>