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

    if(isset($_POST['modifyGym'])){
        $name = htmlspecialchars(trim($_POST['gymName']));
        $area = htmlspecialchars(trim($_POST['gymArea']));
        $owner = htmlspecialchars(trim($_POST['gymOwner']));
        $city = htmlspecialchars(trim($_POST['gymCity']));
        $address = htmlspecialchars(trim($_POST['gymAddress']));
        $phoneNumber = htmlspecialchars(trim($_POST['gymPhone']));
        $id = htmlspecialchars($_GET['gymId']);
        $map = htmlspecialchars(trim($_POST['gymMap']));
        
        if(empty($name)){
            $valid = false;
            $errors = ("Il faut donner un nom à l'évènement");
        }

        if(strlen($name) < 3 || strlen($name) > 50){
            $valid = false;
            $errors = ("Il faut que le nom fasse entre 3 et 50 caractères ");
        }

        if(empty($area)){
            $valid = false;
            $errors = ("Il faut ajouter une surface");
        }

        if(empty($owner)){
            $valid = false;
            $errors = ("Il faut ajouter un directeur");
        }

        if(empty($city)){
            $valid = false;
            $errors = ("Il faut ajouter une ville");
        }

        if(empty($address)){
            $valid = false;
            $errors = ("Il faut ajouter une adresse");
        }

        if(empty($phoneNumber)){
            $valid = false;
            $errors = ("Il faut ajouter un numéro de téléphone");
        }

        if(!is_numeric($phoneNumber)){
            $valid = false;
            $errors = ("Il faut que le numéro de téléphone soit une chaine numérique");
        }

        if(!is_numeric($area)){
            $valid = false;
            $errors = ("Il faut que la surface soit un nombre");
        }

        if(!is_numeric($city)){
            $valid = false;
            $errors = ("La ville n'est pas bonne");
        }

        if(!is_numeric($owner)){
            $valid = false;
            $errors = ("Le directeur n'est pas bon");
        }

        if(strlen($phoneNumber) != 10){
            $valid = false;
            $errors = ("Il faut que le numéro de téléphone fasse 10 chiffres");
        }

        if(empty($map)){
            $valid = false;
            $errors = ("La recherche Google Maps n'est pas bonne");
        } else {
            $map = explode(' ', $map);
            $mapPath = "https://maps.google.com/maps?q=";
            foreach($map as $mapWord){
                $mapPath .= $mapWord;
                if ($mapWord != $map[sizeof($map)-1]){
                    $mapPath .= '%20';
                } else {
                    $mapPath .= '&t=&z=13&ie=UTF8&iwloc=&output=embed';
                }
            }
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
    
        $insertGymQuery = $pdo->prepare("UPDATE RkU_GYMS SET surfaceArea=:surfaceArea, address=:address, user=:user,
        city=:city, name=:name, phoneNumber=:phoneNumber , link=:link WHERE id=:id");

        $insertGymQuery->execute([
            'surfaceArea'=>$area,
            'address'=>$address,
            'user'=>$owner,
            'city'=>$city,
            'name'=>$name,
            'phoneNumber'=>$phoneNumber,
            'id'=>$id,
            'link'=>$mapPath
        ]);

        setMessage('modifyGym', ['La salle de sport a bien été modifiée'], 'success');
        header('Location: ../../user/vues/admin/adminGyms.php');
        exit;
    }
    else{
        setMessage('modifyGym', [$errors], 'warning');
        header('Location: ../vues/gymBO.php');
        exit;
    }
        

}

?>