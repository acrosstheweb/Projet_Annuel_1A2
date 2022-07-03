<?php

require '../../../functions.php';

if(!isConnected()){
    header('Location: ../../../error404.php');
    die();
}

$errors = [];
$userId = $_SESSION['userId'];

$pdo = database();

if(isset($_SESSION['fitcoins'])){
    $ids = array_keys($_SESSION['fitcoins']);
    $idsImplode = implode(',', $ids);

    if(empty($ids)){
        $errors[] = "Il y a eu un problème dans l'envoi du formulaire. Veuillez réessayer.";
        die();
    }
    else{
        $reqPacks = $pdo->query("SELECT * FROM RkU_FITCOINS WHERE id IN (".$idsImplode.")");
        $packs = $reqPacks->fetchAll();
    };


    $userFitcoins = $pdo->prepare("SELECT fitcoin FROM RkU_USER WHERE id=:userId");
    $userFitcoins->execute([
        'userId'=>$userId
    ]);
    $quantityOfFitcoins = $userFitcoins->fetch()['fitcoin'];

    foreach($packs as $pack){
        $quantityOfFitcoins += $_SESSION['fitcoins'][$pack['id']] * $pack['numberOfFitcoins'];
    }

    $addFitcoinsToUSer = $pdo->prepare("UPDATE RkU_USER SET fitcoin=:quantityOfFitcoins WHERE id=:userId");
    $addFitcoinsToUSer->execute([
        'quantityOfFitcoins'=>$quantityOfFitcoins,
        'userId'=>$userId
    ]);

    $userInfoQ = $pdo->prepare("SELECT firstname, email FROM RkU_USER WHERE id=:id");
    $userInfoQ->execute(['id'=>$userId]);
    $userInfo = $userInfoQ->fetch();
    $firstname = $userInfo["firstname"];
    $email = $userInfo["email"];

    $mailContent = '<!DOCTYPE html><html>';
    $mailContent.= '<section align="center">';
    $mailContent.=     '<h1>Confirmation de paiement</h1>';
    $mailContent.=     '<img src="https://pa-atw.fr/sources/img/logo.png" alt="logo">';
    $mailContent.=     '<h3>Bonjour '.$firstname.', nous confirmons votre paiement</h3>';
    $mailContent.=     '<p>Merci de nous faire confiance, nous avons bien reçu votre paiement pour : </p><ul align="center" style="list-style-type: none;">';
    foreach($packs as $pack){
        $n = $pack['name']; // Name
        $q = $_SESSION['fitcoins'][$pack['id']]; // Quantity
        $p = $pack['price'] * $q; // Price
        $mailContent.=     "<li>$q $n - $p €</li>";
    }

    $mailContent.= '</ul><p>Cordialement</p></section>';
    $mailContent.= '</html>';

    $subject = 'Commande Fitness Essential';
    $headers = 'From: Fitness Essential <fitness-essential@pa-atw.fr>' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(mail($email,$subject, $mailContent, $headers)) {
        setMessage('addToAccount', ["Vous avez bien reçu un mail de confirmation de commande"],'success');
    }else{
        $lastError = (string)error_get_last()['message'];
        setMessage('addToAccount', ["Echec de l'envoi du mail de confirmation", "$lastError"], 'warning'); // error_get_last(['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    }

    unset($_SESSION['fitcoins']);
    header('Location: ../vues/thanksBought.php');
    exit();

}


