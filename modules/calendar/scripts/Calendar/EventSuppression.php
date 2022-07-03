<?php
require '../../../../functions.php';

$eventId = htmlspecialchars($_GET['eventId']);

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
    header('Location: ../../../user/vues/admin/adminEvents.php');
    die();
}

$userDelEventQuery = $db->prepare("DELETE FROM RkU_BOOKING WHERE id=:id");
$userDelEventQuery->execute(["id"=>$eventId]);
$userDelUsersQuery = $db->prepare("DELETE FROM RkU_PARTICIPATE WHERE eventId=:id");
$userDelUsersQuery->execute(["id"=>$eventId]);
setMessage('Delete', ["L'évènement a bien été supprimée."], 'success');
header('Location: ../../../user/vues/admin/adminEvents.php');
die();

?>