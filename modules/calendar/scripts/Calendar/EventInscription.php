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
    setMessage('inscriptionEvent', ['Vous n\'êtes pas connecté, merci de vous connecter pour vous inscrire'],'danger');
    header('Location: ' . DOMAIN . 'pleaseLogin.php');
    die();
}
else{
    if($isParticipated == $userId){
        setMessage('inscriptionEvent', ["Vous êtes déjà inscrit à cet évènement"], 'warning');
        header('Location: ' . DOMAIN . 'modules/user/vues/nextBookings.php');
        exit;
    }
    else{
        if($event['price'] <= $fitcoins){
            if($event['places'] == 0){
                setMessage('inscriptionEvent', ["Cette séance est déjà complète"], 'warning');
                header('Location: ' . DOMAIN . 'modules/calendar/vues/reservations.php');

                exit;
            }
            else{
                $places = $pdo->prepare("UPDATE RkU_BOOKING SET places=:places WHERE id=:eventId");
                $places->execute([
                    'eventId'=>$event['id'],
                    'places'=>$event['places']-1
                ]);
        
                $userWallet = $pdo->prepare("UPDATE RkU_USER SET fitcoin=:fitcoin WHERE id=:userId");
                $userWallet->execute([
                    'fitcoin'=>$fitcoins - $event['price'],
                    'userId'=>$userId
                ]);
        
                $inscriptionQuery = $pdo->prepare("INSERT INTO RkU_PARTICIPATE (userId, eventId) VALUES (:userId, :eventId)");
                $inscriptionQuery->execute([
                    'userId'=>$userId,
                    'eventId'=>$event['id']
                ]);
        
                setMessage('inscriptionEvent', ["Vous êtes bien inscrit à la séance : " . $event['name']], 'success');
                header('Location:' . DOMAIN . 'modules/user/vues/nextBookings.php');
                exit;
            }
        }
        else{
            setMessage('inscriptionEvent', ["Vous n'avez pas assez de fitcoins pour réserver cette séance"], 'warning');
            header('Location: ' . DOMAIN . 'modules/subscription/vues/subscriptions.php');
            exit;
        }
    }
}




