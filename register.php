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

$verifChamps = checkFields([
    'civility' => $civility,
    'birthday' => $birthday,
    'lastname' => $lastname,
    'firstname' => $firstname,
    'email' => $email,
    'address' => $address,
    'city' => $city,
    'zipcode' => $zipCode,
    'password' => $password,
    'password-confirm' => $passwordConfirmed
]);

if($verifChamps[0] === true){
    $champs = $verifChamps[1];

    $db = database();
    $insertUserQuery = $db->prepare("INSERT INTO RkU_USER (firstname,lastname,email,address,city,zipcode,civility,birthday,password,role,fitcoin,token_confirm_inscription) VALUES 
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
            'firstname' => $champs['firstname'],
            'lastname' => $champs['lastname'],
            'email' => $champs['email'],
            'address' => $champs['address'],
            'city' => $champs['city'],
            'zipcode' => $champs['zipcode'],
            'civility' => $champs['civility'],
            'birthday' => $champs['birthday'],
            'password' => $champs['password'],
            'role' => 0,
            'fitcoin' => 0,
            'token_confirm_inscription' => $tk
        ]);

        setMessage('Register', ['Inscription réussie ! Vous allez recevoir un mail de confirmation à l\'adresse ' . $email], 'success');
    }else{
        setMessage('Register', [' Echec de l\'envoi du mail', error_get_last()['message']], 'warning'); // error_get_last()['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    }
    header('Location: index.php');
    die();
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('Register', $verifChamps[1], 'warning');
    header('Location: index.php');
    die();
}