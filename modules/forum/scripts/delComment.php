<?php
require '../../../functions.php';

$idQuestion = $_SESSION['idQuestion'];
$idTopic = $_SESSION['idTopic'];

if(empty($_POST['delete-userPasswordInput'])){
    header('Location: error404.php');
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
    header('Location: ../vues/question.php?idTopic='.$idTopic.'&idQuestion='.$idQuestion);
    die();
}

$commentToDeleteId = $_GET['id'];

$userDelQuery = $db->prepare("DELETE FROM RkU_MESSAGE WHERE id=:id");
$userDelQuery->execute(["id"=>$commentToDeleteId]);
setMessage('Delete', ["Le commentaire a bien été supprimé."], 'success');
header('Location: ../vues/question.php?idTopic='.$idTopic.'&idQuestion='.$idQuestion);
die();

?>