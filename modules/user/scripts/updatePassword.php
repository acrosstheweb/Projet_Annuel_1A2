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
$getUserInfoQuery = $db->query("SELECT firstname, email FROM RkU_USER WHERE id=$userId");
$getUserInfo = $getUserInfoQuery->fetch();
$firstname = $getUserInfo['firstname'];
$email = $getUserInfo['firstname'];

$verifpassword = checkFields([
    'password' => $_POST['profilePassword']
]);

if($verifpassword[0] === true){
    $newPassword = $verifpassword[1]['password'];$tk = genToken();

    $href = DOMAIN . "modules/user/scripts/confirmRegister.php?fn=$firstname&tk=$tk";
    $mailContent = '<!DOCTYPE html><html>';
    $mailContent.= '<section align="center">';
    $mailContent.=     '<h1>Changement mot de passe Fitness Essential</h1>';
    $mailContent.=     '<img src="https://pa-atw.fr/sources/img/logo.png" alt="logo">';
    $mailContent.=     '<h3>Bonjour '.$firstname.', vous avez initié un changement d\'adresse mail</h3>';
    $mailContent.=     '<p>Pour acter ce changement merci de bien vouloir cliquer sur le lien ci-dessous 🔌</p>';
    $mailContent.=     '<a href='.$href.'>Changer mon mot de passe</a>';
    $mailContent.= '</section>';
    $mailContent.= '</html>';

    $subject = 'Changement mot de passe Fitness Essential 💪';
    $headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(mail($email,$subject, $mailContent, $headers)) {

        $updatePasswordQuery = $db->prepare("");
        $updatePasswordQuery->execute([

        ]);


        logout();
        setMessage('updateMail', ["Vous avez été déconnecté vous avez reçu un mail à votre nouvelle adresse mail : $newMail"],'success');
        header('Location: ../../../index.php');
    }else{
        setMessage('updateMail', [' Echec de l\'envoi du mail à la nouvelle adresse', error_get_last()['message']], 'warning'); // error_get_last(['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
        header('Location: ../vues/profilePageSecurity.php');
    }

}else{
    setMessage('updateMail', $verifpassword[1], 'warning');
    header('Location: ../vues/profilePageSecurity.php');
}
die();