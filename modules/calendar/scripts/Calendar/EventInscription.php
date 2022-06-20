<?php

require '../../../../functions.php';

$eventId = $_GET['eventId'];

$pdo = database();

$req = $pdo->prepareq("SELECT * FROM RkU_BOOKING WHERE id=:eventId");
$req->execute([
    'eventId'=>$eventId
]);

$result = $req->fetch();

dd($result);