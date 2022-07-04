<?php
require '../../../functions.php';

$idTopic = htmlspecialchars($_GET['idTopic']);

if(empty($_POST['delete-userPasswordInput'])){
    header('../../../Location: error404.php');
    die();
}
$InputPwd = $_POST['delete-userPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'user)
$db = database();

$userPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$userPwdInDbQuery->execute(["id"=>$userId]);
$userPwdInDb = $userPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $userPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'user\", plus que x essais !"], 'warning');
    header('Location: ../vues/forum.php');
    die();
}

$userArchiveQuery = $db->prepare("UPDATE RkU_TOPIC SET status = 0 WHERE id=:id");
$userArchiveQuery->execute(["id"=>$idTopic]);
$userArchiveQuestionsQuery = $db->prepare("UPDATE RkU_QUESTION SET status = 0 WHERE topic=:id");
$userArchiveQuestionsQuery->execute(["id"=>$idTopic]);
setMessage('Delete', ["La catégorie a bien été archivée."], 'success');
header('Location: ../vues/forum.php');
die();
