<?php
require '../../../../functions.php';
if(empty($_POST['delete-adminPasswordInput'])){
    header('Location: ../../../../error404.php');
    die();
}

$InputPwd = $_POST['delete-adminPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $adminPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: ../../vues/admin/users.php');
    die();
}

$userToDeleteId = $_GET['id'];

$userDelQuery = $db->prepare("DELETE FROM RkU_USER WHERE id=:id");
$userDelQuery->execute(["id"=>$userToDeleteId]);
setMessage('Delete', ["L'utilisateur n°" . $userToDeleteId . " a bien été supprimé."], 'success');
header('Location: ../../vues/admin/users.php');
die();