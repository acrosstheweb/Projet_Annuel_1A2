<?php

require '../../../functions.php';

$firstname = $_GET['fn'];
$token = $_GET['tk'];
$db = database();
$checkMailAuthQuery = $db->query("SELECT id FROM RkU_USER WHERE firstname='".$firstname."' AND token_confirm_inscription='".$token."';");
if($checkMailAuthQuery->fetch()){
    $confirmUserQuery = $db->query('UPDATE RkU_USER SET role=1, token_confirm_inscription=NULL;');
    setMessage('ConfirmRegistration', ['Votre compte est bien confirmé !'], 'success');
    header('Location: ../../../index.php');
}else{
    setMessage('ConfirmRegistration', ['Impossible de confirmer la création du compte'], 'warning');
    header('Location: ../../../error404.php');
}
die();