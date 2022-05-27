<?php

require 'functions.php';
if(
    count($_POST) != 9 ||
    empty($_POST['createUser-birthday']) ||
    empty($_POST['createUser-lastName']) ||
    empty($_POST['createUser-firstName']) ||
    empty($_POST['createUser-email']) ||
    empty($_POST['createUser-city']) ||
    empty($_POST['createUser-zipCode']) ||
    empty($_POST['createUser-password']) ||
    empty($_POST['createUser-passwordConfirm']) ||
    empty($_POST['createUser-adminPasswordInput'])
){
    setMessage('RegisterHack', ['Non respect des règles du formulaire d\'ajout utilisateur'],'danger');
    header('Location: error404.php');
    die();
}
$passwordAdmin = $_POST['createUser-adminPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM rku_user WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($passwordAdmin, $adminPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: security.php');
    die();
}

$birthday = $_POST['createUser-birthday'];
$lastname = strtoupper($_POST['createUser-lastName']);
$firstname = ucwords(strtolower($_POST['createUser-firstName']));
$email = strtolower(trim($_POST['createUser-email']));
$city = ucwords(strtolower($_POST['createUser-city']));
$zipCode = $_POST['createUser-zipCode'];
$password = $_POST['createUser-password'];
$passwordConfirm = $_POST['createUser-passwordConfirm'];

$problems = [];

$birthdayArray = explode('-',$birthday); // [YYYY,MM,DD]

if(!checkdate($birthdayArray[1] ,$birthdayArray[2] ,$birthdayArray[0]) || count($birthdayArray)!= 3){
    $problems[] = 'Format de la date de naissance incorrecte';
}else{ // Si le format de la date est correcte
    $ageInSeconds = time() - strtotime($birthday);
    $age = $ageInSeconds / (60/60/24/365.25); // (60/60/24/365.25) permet de convertir des secondes en années
    if($age < 18){
        $problems[] = 'Vous devez avoir plus de 18 ans pour vous inscrire';
    }
}

$exceptions = [' ','-','é','è','ê','ë','à','â','î','ï','ô','ö','û','ü']; // Tableau qui permet de laisser passer ses caractères dans les vérifications des champs (les lettres accentuées n'étant pas reconnu comme des caractères alphabétiques)

if(strlen($lastname) < 2 || strlen($lastname) > 180 || !ctype_alpha(str_replace($exceptions, '', $lastname))){
    $problems[] = 'Le nom de famille doit être entre 2 et 180 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
}

if(strlen($firstname) < 2 || strlen($firstname) > 100 || !ctype_alpha(str_replace($exceptions, '', $firstname))){
    $problems[] = 'Le prénom doit être entre 2 et 100 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $problems[] = 'Format de l\'adresse mail incorrecte';
}else{
    // Gére si l'adresse mail existe déjà
    $db = database();

    $checkUserExistQuery = $db->prepare("SELECT id FROM rku_user WHERE email=:email LIMIT 1");
    $checkUserExistQuery->execute(["email"=>$email]);
    $checkUserExist = $checkUserExistQuery->fetch();

    if(!empty($checkUserExist)){
        $problems[] = "Ce mail est déjà utilisé";
    }
}

if(strlen($city) < 2 || strlen($city) > 180 || !ctype_alpha(str_replace($exceptions, '', $city))){
    $problems[] = 'La ville doit contenir entre 2 et 180 caractères alphabétiques'; // Alphabétiques + $exceptions autorisés
}

if(strlen($zipCode)!= 5 || !ctype_digit($zipCode)){
    $problems[] = 'Le code postal doit contenir exactement 5 chiffres';
}


if(checkPassword($password) === true){
    if($password != $passwordConfirm){
        $problems[] = 'Les mots de passes ne correspondent pas';
    }
}else{
    $problems[] = 'Le mot de passe doit contenir 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial, 8 caractères minimum';
}

if(count($problems) == 0){
    $password = password_hash($_POST['createUser-password'], PASSWORD_DEFAULT);

    $insertUserQuery = $db->prepare("INSERT INTO RkU_user (firstname,lastname,email,address,city,zipcode,civility,birthday,password,role,fitcoin,token_confirm_inscription) VALUES 
                                                                (:firstname, :lastname, :email, :address, :city, :zipcode, :civility, :birthday, :password, :role, :fitcoin, :token_confirm_inscription)");
    $tk = genToken(); // Génération du token pour vérifier l'inscription par mail

    $to = $email;
    $subject = 'Inscription Fitness Essential 💪';
    $message = register_mail($firstname, $tk, 'http://localhost/Projet_Annuel_1A2_github');
    $headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(mail($to,$subject, $message, $headers)){

        $insertUserQuery->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'address' => 'DEFAULT',
            'city' => $city,
            'zipcode' => $zipCode,
            'civility' => 'DEFAULT',
            'birthday' => $birthday,
            'password' => $password,
            'role' => 0,
            'fitcoin' => 0,
            'token_confirm_inscription' => $tk
        ]);

        setMessage('CreateUser', ['Inscription réussie ! L\'utilisateur va recevoir un mail de confirmation à l\'adresse ' . $email], 'success');
    }else{
        setMessage('CreateUser', [' Echec de l\'envoi du mail', error_get_last()['message']], 'warning'); // error_get_last()['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    }
    header('Location: users.php');
    die();
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('CreateUser', $problems, 'warning');
    header('Location: security.php');
    die();
}