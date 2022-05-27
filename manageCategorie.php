<?php
require 'functions.php';

$title = $_POST['modify-title'];
$description = $_POST['modify-description'];
$id = $_GET['idTopic'];
$InputPwd = $_POST['modify-adminPasswordInput'];

if(
    !isset($title) ||
    !isset($description) ||
    empty($InputPwd) ||
    count($_POST) != 3
){
    header('Location: error404.php');
    die();
}

$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM rku_user WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $adminPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: users.php');
    die();
}

$userModifyQuery = $db->prepare("UPDATE RkU_TOPIC SET title=:title, description=:description WHERE id=:idTopic");
$userModifyQuery->execute([
    "title" => $title,
    "description" => $description,
    "idTopic" => $id
]);
setMessage('Modify', ["La catégorie a bien été modifiée."], 'success');
header('Location: forum.php');
die();