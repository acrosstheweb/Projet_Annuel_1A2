<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';
    
    require_once '../scripts/Calendar/Events.php';
    $events = new Calendar\Events();
    
    if(!isset($_GET['id'])){
        header('Location: ../../../error404.php');
        die();
    }

    try {
        $event = $events->find($_GET['id']);
    }
    catch (\Exception $e) {
        header('Location: ../../../error404.php');
        die();
     }

    require '../../../header.php';

    ?>

<h1><?= $event['name']; ?></h1>

<ul>
    <li>Date : <?= (new \DateTime($event['startDate']))->format('d/m/Y'); ?></li>
    <li>Heure de démarrage : <?=  (new \DateTime($event['startDate']))->format('H:i'); ?></li>
    <li>Heure de fin : <?=  (new \DateTime($event['endDate']))->format('H:i'); ?></li>
    <li>Description : <br>
    <?= $event['description']; ?>
    </li>
    <li>Prix : <?= $event['price'] ?> fitcoins</li>
    <li>Sport sélectionné : <?= $event['sport']; ?></li>
    <li>Salle de sport : <?= $event['gym']; ?></li>
</ul>