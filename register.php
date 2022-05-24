<?php
require 'functions.php';
if(
    count($_POST) != 10 ||
    empty($_POST['register-civility']) ||
    empty($_POST['register-birthday']) ||
    empty($_POST['register-lastname']) ||
    empty($_POST['register-firstname']) ||
    empty($_POST['register-email']) ||
    empty($_POST['register-address']) ||
    empty($_POST['register-city']) ||
    empty($_POST['register-zip-code']) ||
    empty($_POST['register-password']) ||
    empty($_POST['register-confirmed-password'])
){
    setMessage('RegisterHack', ['Non respect des règles du formulaire d\'inscription'],'danger');
    header('Location: error404.php');
    die();
}

$civility = $_POST['register-civility'];
$birthday = $_POST['register-birthday'];
$lastname = strtoupper($_POST['register-lastname']);
$firstname = ucwords(strtolower($_POST['register-firstname']));
$email = strtolower(trim($_POST['register-email']));
$address = ucwords(strtolower($_POST['register-address']));
$city = ucwords(strtolower($_POST['register-city']));
$zipCode = $_POST['register-zip-code'];
$password = $_POST['register-password'];
$passwordConfirmed = $_POST['register-confirmed-password'];

$problems = [];
$supportedCivilties = ['M', 'F'];

if(!in_array($civility, $supportedCivilties)){
    $problems[] = 'Civilité non supportée';
}

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

if(strlen($address) < 2 || strlen($address) > 200 || !ctype_alnum(str_replace($exceptions, '', $address))){
    $problems[] = 'L\'adresse doit comprendre entre 2 et 200 caractères alphanumériques'; // Alphnumériques + $exceptions autorisés
}

if(strlen($city) < 2 || strlen($city) > 180 || !ctype_alpha(str_replace($exceptions, '', $city))){
    $problems[] = 'La ville doit contenir entre 2 et 180 caractères alphabétiques'; // Alphabétiques + $exceptions autorisés
}

if(strlen($zipCode)!= 5 || !ctype_digit($zipCode)){
    $problems[] = 'Le code postal doit contenir exactement 5 chiffres';
}


if(checkPassword($password) === true){
    if($password != $passwordConfirmed){
        $problems[] = 'Les mots de passes ne correspondent pas';
    }
}else{
    $problems[] = 'Le mot de passe doit contenir 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial, 8 caractères minimum';
}

if(count($problems) == 0){
    $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);

    $insertUserQuery = $db->prepare("INSERT INTO RkU_user (firstname,lastname,email,address,city,zipcode,civility,birthday,password,role,fitcoin,token_confirm_inscription) VALUES 
                                                                (:firstname, :lastname, :email, :address, :city, :zipcode, :civility, :birthday, :password, :role, :fitcoin, :token_confirm_inscription)");
    $tk = genToken();

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
            'address' => $address,
            'city' => $city,
            'zipcode' => $zipCode,
            'civility' => $civility,
            'birthday' => $birthday,
            'password' => $password,
            'role' => 0,
            'fitcoin' => 0,
            'token_confirm_inscription' => $tk
        ]);

        setMessage('Register', ['Inscription réussie ! Vous allez recevoir un mail de confirmation à l\'adresse ' . $email], 'success');
    }else{
        setMessage('Register', [' Echec de l\'envoi du mail'], 'warning');
    }
    header('Location: index.php');
    die();
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('Register', $problems, 'warning');
    header('Location: index.php');
    die();
}