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

$checkUserQuery = $db->query('SELECT id FROM rku_user WHERE email=:email');
$checkUserQuery->execute([':email'=>$email]);
$userExist = $checkUserQuery->fetch();

var_dump($userExist);





