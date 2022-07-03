<?php

require '../../../functions.php';

$errors = [];
$userId = $_SESSION['userId'];

$pdo = database();

if(isset($_SESSION['fitcoins'])){
    $ids = array_keys($_SESSION['fitcoins']);
    $idsImplode = implode(',', $ids);

    if(empty($ids)){
        $errors[] = "Il y a eu un problème dans l'envoie du formulaire. Veuillez réessayer.";
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

    unset($_SESSION['fitcoins']);
    header('Location: ../vues/thanksBought.php');
    exit();

}


