<?php

require '../../../functions.php';

$pdo = database();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['modifySport'])){
        $name = htmlspecialchars(trim($_POST['sportName']));
        $description = htmlspecialchars(trim($_POST['sportDescription']));
        $id = htmlspecialchars($_GET['sportId']);
        
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
        
    }

    $InputPwd = $_POST['delete-userPasswordInput'];
    $userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'user)
    $db = database();

    $userPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
    $userPwdInDbQuery->execute(["id"=>$userId]);
    $userPwdInDb = $userPwdInDbQuery->fetch()['password'];

    if(!password_verify($InputPwd, $userPwdInDb)){
        setMessage('modifyEvent', ["Mot de passe incorrect, attention \"l'user\", plus que x essais !"], 'warning');
        header('Location: ../../vues/reservations.php');
        die();
    }

    //insertion base de données si valide à faire
    if ($valid) {
    
        $modifySportQuery = $pdo->prepare("UPDATE RkU_SPORT SET name=:name, description=:description WHERE id=:id");

        $modifySportQuery->execute([
            'name'=>$name,
            'description'=>$description,
            'id'=>$id
        ]);

        setMessage('modifySport', ['Votre sport à bien été mis à jour'], 'success');
        header('Location: ../../user/vues/admin/adminSports.php');
    }
    else{
        setMessage('modifySport', [$errors], 'warning');
        header('Location: ../vues/manageSport.php?sportId=' . $id);
    }
    exit;


}
