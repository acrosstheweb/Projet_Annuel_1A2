<?php
require '../../../functions.php';

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['manageSubscription'])){
        $name = trim($_POST['modify-name']);
        $content = trim($_POST['modify-content']);
        $price = $_POST['modify-price'];
        $firstAttribut = trim($_POST['modify-firstAttribut']);
        $secondAttribut = trim($_POST['modify-secondAttribut']);
        $thirdAttribut = trim($_POST['modify-thirdAttribut']);
        $idSubscription = $_GET['idSubscription'];
        $InputPwd = $_POST['modify-adminPasswordInput'];

        if(
            // !isset($name) ||
            // !isset($content) ||
            // !isset($price) ||
            // !isset($firstAttribut) ||
            // !isset($secondAttribut) ||
            // !isset($thirdAttribut) ||
            // empty($InputPwd) ||
            count($_POST) != 8
        ){
            header('Location: error404.php');
            die();
        }


        if(empty($name)){
            $valid = false;
            $errors = ("Il faut donner un nom à l'abonnement");
        }

        if(empty($content)){
            $valid = false;
            $errors = ("Il faut ajouter un contenu à l'abonnement");
        }
        
        if(empty($price)){
            $valid = false;
            $errors = ("Il faut ajouter un prix");
        }

        if(empty($firstAttribut)){
            $valid = false;
            $errors = ("Il faut 3 attributs à l'abonnement");
        }

        if(empty($secondAttribut)){
            $valid = false;
            $errors = ("Il faut 3 attributs à l'abonnement");
        }
        if(empty($thirdAttribut)){
            $valid = false;
            $errors = ("Il faut 3 attributs à l'abonnement");
        }
    }
    
    $userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
    $db = database();
    
    $adminPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
    $adminPwdInDbQuery->execute(["id"=>$userId]);
    $adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

    // var_dump($adminPwdInDb); var_dump($InputPwd); die();
    
    if(!password_verify($InputPwd, $adminPwdInDb)){
        setMessage('Modify', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
        header('Location: ../vues/subscriptions.php');
        die();
    }
    
    if($valid){
        
        $modifySubscription = $db->prepare("UPDATE RkU_SUBSCRIPTION SET name=:name, content=:content, price=:price, firstAttribut=:firstAttribut, secondAttribut=:secondAttribut, thirdAttribut=:thirdAttribut WHERE id=:idSubscription");
        $modifySubscription->execute([
            "name" => $name,
            "content" => $content,
            "price" => $price,
            "firstAttribut" => $firstAttribut,
            "secondAttribut" => $secondAttribut,
            "thirdAttribut" => $thirdAttribut,
            "idSubscription" => $idSubscription
        ]);
        
        setMessage('Modify', ["L'abonnement a bien été modifié."], 'success');
        header('Location: ../vues/subscriptions.php');
        die();
    }
    else{
        setMessage('Modify', [$errors], 'warning');
        header('Location: ../vues/subscriptions.php');
        die();
    }
    
}