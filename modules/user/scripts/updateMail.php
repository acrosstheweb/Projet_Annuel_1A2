<?php
require '../../../functions.php';
if(
    empty($_POST['profileEmail'])
){
    setMessage('UpdateSecHack', ['bypass form'],'danger');
    header('Location: ../../../error404.php');
    die();
}

$userId = $_SESSION['userId'];
$db = database();
$getUserInfoQuery = $db->query("SELECT firstname FROM RkU_USER WHERE id=$userId");
$getUserInfo = $getUserInfoQuery->fetch();
$firstname = $getUserInfo['firstname'];


$verifmail = checkFields([
    'email' => $_POST['profileEmail']
]);
if($verifmail[0] === true){
    $newMail = $verifmail[1]['email'];$tk = genToken();

    $href = DOMAIN . "modules/user/scripts/confirmRegister.php?fn=$firstname&tk=$tk";
    $mailContent = '<!DOCTYPE html><html>';
    $mailContent.= '<section align="center">';
    $mailContent.=     '<h1>Vérification inscription Fitness Essential</h1>';
    $mailContent.=     '<img src="https://pa-atw.fr/sources/img/logo.png" alt="logo">';
    $mailContent.=     '<h3>Bonjour '.$firstname.', vous avez initié un changement d\'adresse mail</h3>';
    $mailContent.=     '<p>Pour vous reconnecter merci de bien vouloir cliquer sur le lien afin d\'authentifier votre accès 🔌</p>';
    $mailContent.=     '<a href='.$href.'>Vérifier votre nouvelle adresse mail</a>';
    $mailContent.= '</section>';
    $mailContent.= '</html>';

    $subject = 'Changement adresse mail Fitness Essential 💪';
    $headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';

    if(mail($newMail,$subject, $mailContent, $headers)) {

        $updateMailQuery = $db->prepare("UPDATE RkU_USER SET email=:email, token_confirm_inscription=:tk, role=:role WHERE id=:id");
        $updateMailQuery->execute([
            ':email'=> $newMail,
            ':tk'=> $tk,
            ':role'=> 0,
            ':id'=> $userId
        ]);
        logout();
        setMessage('updateMail', ["Vous avez été déconnecté vous avez reçu un mail à votre nouvelle adresse mail : $newMail"],'success');
        header('Location: ../../../index.php');
    }else{
        setMessage('updateMail', [' Echec de l\'envoi du mail à la nouvelle adresse', error_get_last()['message']], 'warning'); // error_get_last(['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
        header('Location: ../vues/profilePageSecurity.php');
    }

}else{
    setMessage('updateMail', $verifmail[1], 'warning');
    header('Location: ../vues/profilePageSecurity.php');
}
die();