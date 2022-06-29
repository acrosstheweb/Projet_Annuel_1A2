<?php
require '../../../functions.php';
if(
    empty($_POST['profilePassword']) ||
    empty($_POST['profileNewPassword']) ||
    empty($_POST['profileConfirmNewPassword'])
){
    setMessage('UpdateSecHack', ['Aucun champ renseigné, bypass form'],'danger');
    header('Location: ../../../error404.php');
    die();
}

$userId = $_SESSION['userId'];
$db = database();
$getUserInfoQuery = $db->query("SELECT firstname, email, password FROM RkU_USER WHERE id=$userId");
$getUserInfo = $getUserInfoQuery->fetch();
$firstname = $getUserInfo['firstname'];
$email = $getUserInfo['email'];
$pwdInDb = $getUserInfo['password'];

if(!password_verify($_POST['profilePassword'], $pwdInDb)){
    setMessage('updatePassword', ["Mot de passe incorrect"], 'warning');
    header('Location: ../vues/profilePageSecurity.php');
    die();
}

$verifpassword = checkFields([
    'password' => $_POST['profileNewPassword'],
    'password-confirm'=> $_POST['profileConfirmNewPassword']
]);

if($verifpassword[0] === true){
    $newPassword = $verifpassword[1]['password']; // Mdp déjà chiffré hashé crypté (tout ce que tu veux) dans la fonction checkFields :)

    $mailContent = '<!DOCTYPE html><html>';
    $mailContent.= '<section align="center">';
    $mailContent.=     '<h1>Changement mot de passe Fitness Essential</h1>';
    $mailContent.=     '<img src="https://pa-atw.fr/sources/img/logo.png" alt="logo">';
    $mailContent.=     '<h3>Bonjour '.$firstname.', vous avez initié un changement de mot de passe</h3>';
    $mailContent.=     '<p>Si vous n\'êtes pas à l\'origine de ce changement, veuillez contacter un administrateur 🔌</p>';
    $mailContent.= '</section>';
    $mailContent.= '</html>';

    $subject = 'Changement mot de passe Fitness Essential';
    $headers = 'From: Fitness Essential <fitness-essential@pa-atw.fr>' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(mail($email,$subject, $mailContent, $headers)) {

        $updatePasswordQuery = $db->prepare("UPDATE RkU_USER SET password=:password WHERE id=:id");
        $updatePasswordQuery->execute([
            ':password'=> $newPassword,
            ':id'=>$userId
        ]);

        logout();
        setMessage('updatePassword', ["Vous avez été déconnecté par mesure de sécurité, vous pouvez vous reconnecter avec votre nouveau mot de passe"],'success');
        header('Location: ../../../index.php');
    }else{
        $lastError = (string)error_get_last()['message'];
        setMessage('updatePassword', ["Echec de l'envoi du mail à la nouvelle adresse", "$lastError"], 'warning'); // error_get_last(['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
        /*dd(error_get_last()['message']);*/
        header('Location: ../vues/profilePageSecurity.php');
    }

}else{
    setMessage('updatePassword', $verifpassword[1], 'warning');
    header('Location: ../vues/profilePageSecurity.php');
}
die();