<?php

require '../../../../functions.php';

$pdo = database();

$eventReq = $pdo->prepare("SELECT * FROM RkU_BOOKING WHERE id=:id");
$eventReq->execute([
    'id'=>htmlspecialchars($_GET['eventId'])
]);
$event = $eventReq->fetch();


$userId = $_SESSION['userId'];

$userReq = $pdo->prepare("SELECT fitcoin FROM RkU_USER WHERE id=:id");
$userReq->execute([
    'id'=>$userId
]);
$fitcoins = $userReq->fetch()['fitcoin'];

$participateReq = $pdo->prepare("SELECT userId FROM RkU_PARTICIPATE WHERE eventId=:eventId");
$participateReq->execute([
    'eventId'=>$event['id']
]);
$isParticipated = $participateReq->fetch()['userId'];

if(!isConnected()){
    setMessage('eventDesinscription', ['Vous n\'êtes pas connecté, merci de vous connecter pour vous désinscrire (si vous vous êtes inscrit)'],'danger');
    header('Location: ../../vues/eventUser.php?id=' . $event['id']);
    die();
}
else{
    if($isParticipated){
        $deleteUserFromBooking = $pdo->prepare("DELETE FROM RkU_PARTICIPATE WHERE userId=:userId AND eventId=:eventId");
        $deleteUserFromBooking->execute([
            'userId'=>$userId,
            'eventId'=>$event['id']
        ]);

        $places = $pdo->prepare("UPDATE RkU_BOOKING SET places=:places WHERE id=:eventId");
        $places->execute([
            'eventId'=>$event['id'],
            'places'=>$event['places']+1
        ]);

        $userWallet = $pdo->prepare("UPDATE RkU_USER SET fitcoin=:fitcoin WHERE id=:userId");
        $userWallet->execute([
            'fitcoin'=>$fitcoins + $event['price'],
            'userId'=>$userId
        ]);

        setMessage('eventDesinscription', ['Vous êtes bien désinscrit'],'success');
        header('Location: ../../vues/eventUser.php?id=' . $event['id']);
        die();
    }
    else{
        setMessage('eventDesinscription', ['Vous n\'êtes pas inscrit'],'danger');
        header('Location: ../../vues/eventUser.php?id=' . $event['id']);
        die();
    }
}