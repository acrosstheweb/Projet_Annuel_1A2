<?php
require 'functions.php';

if(
    count($_POST) != 2 ||
    empty($_POST['login-email']) ||
    empty($_POST['login-password'])
){
    setMessage('LoginHack', ['Non respect des règles du formulaire de connexion'],'danger');
    header('Location: error404.php');
    die();
}

$email = strtolower(trim($_POST['login-email']));
$password = $_POST['login-password'];

$problems = [];
$db = database();

$checkUserQuery = $db->prepare('SELECT id, pwd FROM rku_user WHERE email=:email');
$checkUserQuery->execute([':email'=>$email]);
$user = $checkUserQuery->fetch();

if($user === false){
    $userExist = false;
    setMessage('Connection', ['Nom d\'utilisateur ou mot de passe incorrect'], 'warning');
}else{
    $userExist = true;
    $pwdInDb = $user['pwd'];

    if(password_verify($password, $pwdInDb)){
        $_SESSION['userId'] = $user['id'];
        setMessage('Connection', ['Connexion réussie'], 'success');
    }else{
        setMessage('Connection', ['Nom d\'utilisateur ou mot de passe incorrect'], 'warning');
    }
}
header('Location: index.php');
die();