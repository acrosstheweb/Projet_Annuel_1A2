<?php
require '../../../functions.php';
if(empty($_POST['userdel-password'])){
    SetMessage('DeleteUser',['bypass form suppression utilisateur'], 'danger');
    header('Location: ../../../error404.php');
    die();
}

$pwd = $_POST['userdel-password'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$pwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$pwdInDbQuery->execute(["id"=>$userId]);
$pwdInDb = $pwdInDbQuery->fetch()['password'];

if(!password_verify($pwd, $pwdInDb)){
    setMessage('DeleteUser', ["Mot de passe incorrect"], 'warning');
    header('Location: ../vues/profilePageSecurity.php');
    die();
}

$userDelQuery = $db->prepare("DELETE FROM RkU_USER WHERE id=:id");
$userDelQuery->execute(["id"=>$userId]);
logout();
setMessage('DeleteUser', ["Votre compte a bien été supprimé."], 'success');
header('Location: ../../../index.php');
die();
