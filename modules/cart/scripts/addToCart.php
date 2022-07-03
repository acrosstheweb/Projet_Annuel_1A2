<?php


require '../../../functions.php';


$pdo = database();
$userId = $_SESSION['userId'];

$reqSubscription = $pdo->prepare("SELECT subscription FROM RkU_USER WHERE id=:id");
$reqSubscription->execute([
    'id'=>$userId
]);
$usersubscription = $reqSubscription->fetch()['subscription'];


$errors = [];
$valid = true;


// Vérification de l'unicité du nombre d'abonnement du user
if(isset($_GET['subscriptionId'])){
    if(!isset($_SESSION['subscription'])){
        $_SESSION['subscription'] = [];
    }
    elseif(isset($_SESSION['subscription'])){
        $errors[] = 'Vous ne pouvez pas avoir plusieurs abonnements';
        setMessage('addSubscription', $errors, 'warning');
        header('Location: ../../subscription/vues/subscriptions.php');
        die();
    }
    elseif($usersubscription != NULL){
        $errors[] = 'Vous ne pouvez pas avoir plusieurs abonnements';
        setMessage('addSubscription', $errors, 'warning');
        header('Location: ../../subscription/vues/subscriptions.php');
        die();
    }
}

if(!isset($_SESSION['fitcoins'])){
    $_SESSION['fitcoins'] = [];
}

if(!isset($_GET['subscriptionId'])){
    if(!isset($_GET['fitcoinsId'])){
        header('Location: ../../error404.php');
        die();
    }
    else{

        // On récupère ici l'id du produit qui a été envoyé dans l'URL
        // Cela permet de vérifier que le produit existe bien en base de donnée, et permet d'ajouter des éléments inexistants au panier
        $reqFitcoinsId = $pdo->prepare("SELECT id FROM RkU_FITCOINS WHERE id=:id");
        $reqFitcoinsId->execute([
            'id'=>htmlspecialchars(trim($_GET['fitcoinsId']))
        ]);
        $fitcoinsId = $reqFitcoinsId->fetch()['id'];

        if(empty($fitcoinsId)){ 
            $errors[] = 'Ce produit n\'existe pas';
            $valid = false;
        }
        
        if(!is_numeric($fitcoinsId)){
            $errors[] = 'Erreur lors de l\'envoi du formulaire, veuillez réessayer';
            $valid = false;
        }

        if($valid){

            if(isset($_SESSION['fitcoins'][$fitcoinsId])){
                $_SESSION['fitcoins'][$fitcoinsId]++;
            }else{
                $_SESSION['fitcoins'][$fitcoinsId] = 1;
            }


            setMessage('addFitcoins', ['Le pack a bien été rajouté à votre panier'], 'success');
            header('Location: ' . DOMAIN . 'modules/cart/vues/cart.php');
        }else{
            setMessage('addFitcoins', $errors, 'warning');
            header('Location: ../../subscription/vues/subscriptions.php');
        }
        die();
    }
}
else{

    $reqSubscriptionId = $pdo->prepare("SELECT id FROM RkU_SUBSCRIPTION WHERE id=:id");
    $reqSubscriptionId->execute([
        'id'=>htmlspecialchars(trim($_GET['subscriptionId']))
    ]);
    $subscriptionId = $reqSubscriptionId->fetch()['id'];

    if(empty($subscriptionId)){ 
        $errors[] = 'Ce produit n\'existe pas';
        $valid = false;
    }

    if(!is_numeric($subscriptionId)){
        $errors[] = 'Erreur lors de l\'envoi du formulaire, veuillez réessayer';
        $valid = false;
    }

    if($valid){
        array_push($_SESSION['subscription'], $subscriptionId);

        setMessage('addFitcoins', ['L\'abonnement a bien été rajouté à votre panier'], 'success');
        header('Location: ' . DOMAIN . 'modules/cart/vues/cart.php');
    }else{
        setMessage('addSubscription', $errors, 'warning');
        header('Location: ../../subscription/vues/subscriptions.php');
    }
    die();
}