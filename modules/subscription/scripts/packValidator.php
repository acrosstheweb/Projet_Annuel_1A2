<?php

require '../../../functions.php';

$pdo = database();

// var_dump($_FILES); echo "<br>";
// var_dump($_POST); 
// die();

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createPack'])){
        $name = htmlspecialchars(trim($_POST['packName']));
        $description = htmlspecialchars(trim($_POST['packDescription']));
        $price = htmlspecialchars(trim($_POST['packPrice']));
        $fitcoinsNumber = htmlspecialchars(trim($_POST['packFitcoins']));
        
        if(empty($name)){
            $valid = false;
            $errors = ("Il faut donner un nom à l'évènement");
        }

        if(strlen($name) < 3 || strlen($name) > 50){
            $valid = false;
            $errors = ("Il faut que le nom fasse entre 3 et 50 caractères ");
        }

        if(empty($description)){
            $valid = false;
            $errors = ("Il faut ajouter une surface");
        }

        if(strlen($description) < 5 || strlen($description) > 255){
            $valid = false;
            $errors = ("Il faut que le nom fasse entre 5 et 255 caractères ");
        }

        if(empty($price)){
            $valid = false;
            $errors = ("Il faut ajouter un prix");
        }

        if(empty($fitcoinsNumber)){
            $valid = false;
            $errors = ("Il faut ajouter un numéro de téléphone");
        }

        if(!is_numeric($fitcoinsNumber)){
            $valid = false;
            $errors = ("Il faut que le numéro de téléphone soit une chaine numérique");
        }

        if(!is_numeric($price)){
            $valid = false;
            $errors = ("Il faut que le prix soit une chaine numérique");
        }

    }

    //insertion base de données si valide à faire
    if ($valid) {
    
        $insertPackQuery = $pdo->prepare("INSERT INTO RkU_FITCOINS (name, description, price, numberOfFitcoins)
                VALUES 
                (:name, :description, :price, :numberOfFitcoins)");

        $insertPackQuery->execute([
            'name'=>$name,
            'description'=>$description,
            'price'=>$price,
            'numberOfFitcoins'=>$fitcoinsNumber
        ]);

        setMessage('createPack', ['Votre nouveau pack a bien été crée'], 'success');
        header('Location: ../../user/vues/admin/adminFitcoins.php');
    }
    else{
        setMessage('createPack', [$errors], 'warning');
        header('Location: ../vues/addNewPack.php');
    }
    exit;


}

?>