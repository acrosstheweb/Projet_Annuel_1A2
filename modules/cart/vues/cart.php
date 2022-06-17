<?php
    $title = "Fitness Essential - Panier";
    $content = "Votre panier";
    $currentPage = 'cart';
    require '../../../header.php';

    if(!isConnected()){
        echo "Pour accéder au forum, merci de vous inscrire";
        die();
    }

?>

<h1>Votre panier</h1>

