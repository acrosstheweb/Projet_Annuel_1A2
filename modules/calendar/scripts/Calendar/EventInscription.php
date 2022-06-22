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
    header('Location: ../../vues/eventUser.php?id=' . $event['id']);
    die();
}
else{
    if($isParticipated == $userId){
        setMessage('inscriptionEvent', ["Vous êtes déjà inscrit à cet évènement, vous pouvez vous rendre sur
        sur <a href='../vues/reservations.php'>cette page</a> pour réserver une autre séance"], 'warning');
        header('Location: ../../vues/eventuser.php?id=' . $event['id']);
        exit;
    }
    else{
        if($event['price'] <= $fitcoins){
            if($event['places'] == 0){
                setMessage('inscriptionEvent', ["Il n'y a plus suffisamment de place pour vous inscrire, vous pouvez aller checker
                sur <a href='../vues/reservations.php'>cette page</a> pour réserver une autre séance"], 'warning');
                header('Location: ../../vues/eventUser.php?id=' . $event['id']);
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
                header('Location: ../../vues/eventUser.php?id=' . $event['id']);
                exit;
            }
        }
        else{
            setMessage('inscriptionEvent', ["Vous n'avez pas assez de fitcoins pour réserver cette séance, vous pouvez vous rendre
            sur <a href='#'>cette page</a> pour en acheter"], 'warning');
            header('Location: ../../vues/eventUser.php?id=' . $event['id']);
            exit;
        }
    }
}




