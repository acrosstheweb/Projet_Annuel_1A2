<?php
require '../../../functions.php';

$packId = htmlspecialchars($_GET['packId']);

if(!is_numeric($packId)){
    header('Location: ../../../error404.php');
    die();
}

if(empty($_POST['delete-userPasswordInput'])){
    header('Location: ../../../error404.php');
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
    header('Location: ../../user/vues/admin/adminPack.php');
    die();
}

$userDelQuery = $db->prepare("DELETE FROM RkU_FITCOINS WHERE id=:id");
$userDelQuery->execute(["id"=>$packId]);
setMessage('Delete', ["Le pack a bien été supprimé."], 'success');
header('Location: ../../user/vues/admin/adminPack.php');
die();

?>