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

    if(isset($_POST['modifyPack'])){
        $name = htmlspecialchars(trim($_POST['packName']));
        $description = htmlspecialchars(trim($_POST['packDescription']));
        $price = htmlspecialchars(trim($_POST['packPrice']));
        $fitcoinsNumber = htmlspecialchars(trim($_POST['packFitcoins']));
        $id = htmlspecialchars($_GET['packId']);
        
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

        if(!is_numeric($id)){
            $valid = false;
            $errors = ("Problème lors de l'envoi du formulaire");
        }
    }

    $InputPwd = $_POST['delete-userPasswordInput'];
    $userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'user)
    $db = database();

    $userPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
    $userPwdInDbQuery->execute(["id"=>$userId]);
    $userPwdInDb = $userPwdInDbQuery->fetch()['password'];

    if(!password_verify($InputPwd, $userPwdInDb)){
        setMessage('modifyEvent', ["Mot de passe incorrect, attention \"l'user\", plus que x essais !"], 'warning');
        header('Location: ../vues/gymBO.php');
        die();
    }

    //insertion base de données si valide à faire
    if ($valid) {
    
        $insertPackQuery = $pdo->prepare("UPDATE RkU_FITCOINS SET name=:name, description=:description, price=:price, numberOfFitcoins=:numberOfFitcoins WHERE id=:id");

        $insertPackQuery->execute([
            'name'=>$name,
            'description'=>$description,
            'price'=>$price,
            'numberOfFitcoins'=>$fitcoinsNumber,
            'id'=>$id
        ]);

        setMessage('modifyPack', ['Le pack a bien été modifié'], 'success');
        header('Location: ../../user/vues/admin/adminFitcoins.php');
        exit;
    }
    else{
        setMessage('modifyPack', [$errors], 'warning');
        header('Location: ../vues/packBO.php');
        exit;
    }
        

}

?>