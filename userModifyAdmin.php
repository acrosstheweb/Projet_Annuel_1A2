<?php
require 'functions.php';
if(
    empty($_POST['modify-lastName']) ||
    empty($_POST['modify-firstName']) ||
    empty($_POST['modify-birthday']) ||
    empty($_POST['modify-email']) ||
    empty($_POST['modify-address']) ||
    empty($_POST['modify-zipCode']) ||
    empty($_POST['modify-city']) ||
    empty($_POST['modify-adminPasswordInput']) ||
    count($_POST) != 8
){
    header('Location: error404.php');
    die();
}
$InputPwd = $_POST['modify-adminPasswordInput'];
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

$lastname = $_POST['modify-lastName'];
$firstname = $_POST['modify-firstName'];
$birthday = $_POST['modify-birthday'];
$email = $_POST['modify-email'];
$address = $_POST['modify-address'];
$zipcode = $_POST['modify-zipCode'];
$city = $_POST['modify-city'];
$userToModifyId = $_GET['id'];

$userModifyQuery = $db->prepare("UPDATE rku_user SET lastname=:lastname, firstname=:lastname, birthday=:birthday, email=:email, address=:address, zipcode=:zipcode, city=:city, WHERE id=:id");
$userModifyQuery->execute([
    "lastname" => $lastname,
    "firstname" => $firstname,
    "birthday" => $birthday,
    "email" => $email,
    "address" => $address,
    "zipcode" => $zipcode,
    "city" => $city,
    "id" => $userToModifyId
]);
setMessage('Modify', ["L'utilisateur n°" . $userToModifyId . " a bien été supprimé."], 'success');
header('Location: users.php');
die();