<?php
require '../../../functions.php';

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['modifySubscription'])){
        $name = htmlspecialchars(trim($_POST['subscriptionName']));
        $content = htmlspecialchars(trim($_POST['subscriptionContent']));
        $price = $_POST['subscriptionPrice'];
        $firstAttribut = htmlspecialchars(trim($_POST['subscriptionFirstAttribut']));
        $secondAttribut = htmlspecialchars(trim($_POST['subscriptionSecondAttribut']));
        $thirdAttribut = htmlspecialchars(trim($_POST['subscriptionThirdAttribut']));
        $idSubscription = $_GET['subscriptionId'];
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
            header('Location: ../../../error404.php');
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

        if(!is_numeric($price)){
            $valid = false;
            $errors = ("Le prix doit être une chaine numérique");
        }

        if(!is_numeric($idSubscription)){
            $valid = false;
            $errors = ("Erreur lors de l'envoi du formulaire");
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
        setMessage('modifySubscription', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
        header('Location: ../vues/subscriptionBO.php?subscriptionId=' . $idSubscription);
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
        
        setMessage('modifySubscription', ["L'abonnement a bien été modifié."], 'success');
        header('Location: ../../user/vues/admin/adminSubscriptions.php');
        die();
    }
    else{
        setMessage('modifySubscription', [$errors], 'warning');
        header('Location: ../vues/subscriptionBO.php?subscriptionId=' . $idSubscription);
        die();
    }
    
}