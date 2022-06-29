<?php
// Utilisé pour confirmation d'inscription mais également confirmation du changement d'adresse mail
require '../../../functions.php';

$firstname = htmlspecialchars($_GET['fn']);
$token = htmlspecialchars($_GET['tk']);
$db = database();
$checkMailAuthQuery = $db->prepare("SELECT id FROM RkU_USER WHERE firstname=:firstname AND token_confirm_inscription=:token;");
$checkMailAuthQuery->execute([
    'firstname'=>$firstname,
    'token'=>$token
]);
$id = $checkMailAuthQuery->fetch()["id"];
if($id){
    $confirmUserQuery = $db->prepare('UPDATE RkU_USER SET role=1, token_confirm_inscription=NULL WHERE id=:id;');
    $confirmUserQuery->execute(['id'=>$id]);
    setMessage('ConfirmRegistration', ['Votre compte est bien confirmé !'], 'success');
    header('Location: ../../../index.php');
}else{
    setMessage('ConfirmRegistration', ['Impossible de confirmer la création du compte'], 'warning');
    header('Location: ../../../error404.php');
}
die();