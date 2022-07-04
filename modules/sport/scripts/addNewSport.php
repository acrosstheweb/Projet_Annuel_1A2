<?php

require '../../../functions.php';

$pdo = database();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createSport'])){
        $name = htmlspecialchars(trim($_POST['sportName']));
        $description = htmlspecialchars(trim($_POST['sportDescription']));
        
        if(empty($name)){
            $valid = false;
            $errors = ("Il faut donner un nom au sport");
        }

        if(strlen($name) < 3 || strlen($name) > 50){
            $valid = false;
            $errors = ("Il faut que le nom fasse entre 3 et 50 caractères ");
        }

        if(empty($description)){
            $valid = false;
            $errors = ("Il faut ajouter une description au sport");
        }

        if(strlen($description > 500)){
            $valid = false;
            $errors = ("La description doit faire moins de 500 caractères");
        }

    //insertion base de données si valide à faire
        if ($valid) {
        
            $insertSportQuery = $pdo->prepare("INSERT INTO RkU_SPORT (name, description)
                    VALUES 
                    (:name, :description)");

            $insertSportQuery->execute([
                'name'=>$name,
                'description'=>$description
            ]);

            setMessage('createSport', ['Votre nouveau sport a bien été créé'], 'success');
            header('Location: ../../user/vues/admin/adminSports.php');
        }
        else{
            setMessage('createSport', [$errors], 'warning');
            header('Location: ../vues/newSport.php');
        }
        exit;

    }
}