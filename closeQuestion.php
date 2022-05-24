<?php
require 'functions.php';

var_dump($_GET); var_dump($_POST); die();

$idQuestion = $_SESSION['idQuestion'];
$idTopic = $_SESSION['idTopic'];

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

$idQuestionToClose = $_GET['id'];

$userDelQuery = $db->prepare("UPDATE RkU_QUESTION SET status = 0 WHERE id=:id");
$userDelQuery->execute(["id"=>$idQuestionToClose]);
setMessage('Closed', ["La question" . $idQuestionToClose . " a bien été clôturée."], 'success');
header('Location: categorie.php?idTopic='.$idTopic);
die();

?>