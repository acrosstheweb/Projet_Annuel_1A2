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
    Message("inscriptionEvent");
    Message("eventDesinscription");

    $pdo = database();

    $req = $pdo->prepare("SELECT name FROM RkU_SPORT WHERE id=:id");
    $req->execute([
        'id'=>$event['sport']
    ]);
    $sportName = $req->fetch();
    ?>

<h1 align="center"><?= $event['name']; ?></h1>

<div class="container">
    <ul>
        <li>Date : <?= (new \DateTime($event['startDate']))->format('d/m/Y'); ?></li>
        <li>Heure de démarrage : <?=  (new \DateTime($event['startDate']))->format('H:i'); ?></li>
        <li>Heure de fin : <?=  (new \DateTime($event['endDate']))->format('H:i'); ?></li>
        <li>Description : <br>
        <?= $event['description']; ?>
        </li>
        <li>Prix : <?= $event['price'] ?> fitcoins</li>
        <li>Sport sélectionné : <?= $sportName['name']; ?></li>
        <li>Salle de sport : <?= $event['gym']; ?></li>
        <li>Nombre de places : <?= $event['places'] ?></li>
    </ul>
    <a href="../scripts/Calendar/EventInscription.php?eventId=<?= $event['id'] ?>"><button type = "button" >S'inscrire</button></a>
    <a href="../scripts/Calendar/EventDesinscription.php?eventId=<?= $event['id'] ?>"><button type = "button" >Se désinscrire</button></a>
</div>
