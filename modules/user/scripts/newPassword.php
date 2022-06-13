<?php
require '../../../functions.php';

if(count($_POST) != 1 ||
   empty($_POST['passwordForgotten-email'])
){
    setMessage('newPassword',['Contournement formulaire de réinitialisation'],'danger');
    header('Location: ../vues/passwordForgotten.php');
    die();
}
$userId = $_SESSION['userId'];
$verifMail = checkFields([
    'email' => 'wissem.derghal@gmail.com'/*$_POST['passwordForgotten-email']*/
], false);

if($verifMail[0] === true){
    $mail = $verifMail[1];

    $db = database();
    $checkChangePwdStatusQuery = $db->prepare("SELECT changePassword FROM RkU_USER WHERE id=:id");
    $checkChangePwdStatusQuery->execute([
        'id'=>$userId
    ]);
    $changePwdStatus = $checkChangePwdStatusQuery->fetch()[0];
    if($changePwdStatus == 0){
        $pwdclear = uniqidReal(16) . '$' . time()%13;

        $src = /*DOMAIN .*/'https://pa-atw.fr/sources/img/logo.png';
        $to = $mail;
        $subject = 'Nouveau mot de passe Fitness Essential 💪';
        $message = "<html><section><h1>Identifiants Fitness Essential</h1><img src=' . $src . ' alt='logo'><ul><li>Email : $mail</li><li>Mot de passe : $pwdclear</li></ul></section></html>";
        $headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
        $headers .= "MIME-Version: 1.0" . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=iso-8859-1';

        if(mail($to,$subject, $message, $headers)) {
            $newPwd = password_hash($pwdclear, PASSWORD_DEFAULT);
            $changePwdQuery = $db->prepare("UPDATE RkU_USER SET password=:password, changePassword = 1 WHERE id=:id");
            $changePwdQuery->execute([
                'password'=>$newPwd,
                'id'=>$userId
            ]);
        }else{
            setMessage('newPassword', ['Nous sommes désolés, nous n\'avons pas réussi à envoyé le mail avec vos nouvelles informations'], 'warning');
            header('Location: ../vues/passwordForgotten.php');
            die();
        }
    }




}else{
    dd($verifMail[1]);
}

setMessage('newPassword', ['Si un compte a été crée avec cette adresse mail, vous recevrez un mail de réinitialisation du mot de passe'], 'info');

die();