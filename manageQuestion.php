<?php
require 'functions.php';


$idTopic = $_GET['idTopic'];
$idQuestion = $_GET['idQuestion'];
$status = $_GET['status'];

if(empty($_POST['delete-userPasswordInput'])){
    header('Location: error404.php');
    die();
}
$InputPwd = $_POST['delete-userPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'user)
$db = database();

$userPwdInDbQuery = $db->prepare("SELECT password FROM rku_user WHERE id=:id");
$userPwdInDbQuery->execute(["id"=>$userId]);
$userPwdInDb = $userPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $userPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'user\", plus que x essais !"], 'warning');
    header('Location: question.php?idTopic='.$idTopic.'&idQuestion='.$idQuestion);
    die();
}


if($status == 1)
    $questionManageQuery = $db->prepare("UPDATE RkU_QUESTION SET status = 0 WHERE id=:idQuestion");
elseif ($status == 0) {
    $questionManageQuery = $db->prepare("UPDATE RkU_QUESTION SET status = 1 WHERE id=:idQuestion");
}


$questionManageQuery->execute(["idQuestion"=>$idQuestion]);
setMessage('Closed', ["La question" . $idQuestion . " a bien été clôturée."], 'success');
header('Location: categorie.php?idTopic='.$idTopic);
die();

?>