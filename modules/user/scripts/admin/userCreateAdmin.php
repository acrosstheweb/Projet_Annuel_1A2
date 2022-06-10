<?php

require '../../../../functions.php';
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
    header('Location: ../../../../error404.php');
    die();
}
$passwordAdmin = $_POST['createUser-adminPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($passwordAdmin, $adminPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: ../../vues/admin/security.php');
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

$verifChamps = checkFields([
    'birthday' => $birthday,
    'lastname' => $lastname,
    'firstname' => $firstname,
    'email' => $email,
    'city' => $city,
    'zipcode' => $zipCode,
    'password' => $password,
    'password-confirm' => $passwordConfirm
]);

if($verifChamps[0] === true){
    $champs = $verifChamps[1];

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
            'address' => 'DEFAULT',
            'city' => $champs['city'],
            'zipcode' => $champs['zipcode'],
            'civility' => 'DEFAULT',
            'birthday' => $champs['birthday'],
            'password' => $champs['password'],
            'role' => 0,
            'fitcoin' => 0,
            'token_confirm_inscription' => $tk
        ]);

        setMessage('CreateUser', ['Inscription réussie ! L\'utilisateur va recevoir un mail de confirmation à l\'adresse ' . $email], 'success');
    }else{
        setMessage('CreateUser', [' Echec de l\'envoi du mail', error_get_last()['message']], 'warning'); // error_get_last()['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    }
    header('Location: ../../vues/admin/users.php');
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('CreateUser', $verifChamps[1], 'warning');
    header('Location: ../../vues/admin/security.php');
}
die();