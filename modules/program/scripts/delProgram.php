<?php
require '../../../functions.php';

if(!isAdmin()){
    header('Location: ../../../error404.php');
    die();
}

if(
    count($_POST) != 1 ||
    empty($_POST['delProgram-password']) ||
    empty($_GET['pId'])
){
    setMessage('delProgram', ['Formulaire de suppression de programme invalide'], 'danger');
    header('Location: ../../user/vues/admin/adminPrograms.php');
    die();
}

$pwd = htmlspecialchars($_POST['delProgram-password']);
$userId = $_SESSION['userId'];

$db = database();
$pwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$pwdInDbQuery->execute(['id'=>$userId]);

$pwdInDb = $pwdInDbQuery->fetch()['password'];

if(!password_verify($pwd,$pwdInDb)){
    setMessage('delProgram', ["Mot de passe incorrect, attention \"l'user\", plus que x essais !"], 'warning');
    header('Location: ../../user/vues/admin/adminPrograms.php');
    die();
}

$programId = htmlspecialchars($_GET['pId']);

$delProgramQuery = $db->prepare("DELETE FROM RkU_PROGRAM WHERE id=:id");
$delContainQuery = $db->prepare("DELETE FROM RkU_CONTAINS WHERE programId=:id");

$delProgramQuery->execute(['id'=>$programId]);
$delContainQuery->execute(['id'=>$programId]);

setMessage('delProgram', ['Programme supprimé avec succès !'], 'success');
header('Location: ../../user/vues/admin/adminPrograms.php');
die();