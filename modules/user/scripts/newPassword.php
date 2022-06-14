<?php
require '../../../functions.php';
if(count($_POST) != 1 ||
    empty($_POST['passwordForgotten-email'])
){
    setMessage('newPassword',['Contournement formulaire de réinitialisation'],'danger');
    header('Location: ../vues/passwordForgotten.php');
    die();
}

if(isConnected()){
    setMessage('newPassword', ['T\'es déjà connecté, pourquoi tu penses avoir oublier ton mot de passe ??'], 'info');
    header('Location: ../../../index.php');
    die();
}
$verifMail = checkFields([
    'email' => $_POST['passwordForgotten-email']
], false);

if($verifMail[0] === true){
    $mail = $verifMail[1]['email'];
    $db = database();

    $checkMailExistQuery = $db->prepare("SELECT id FROM RkU_USER WHERE email=:email");
    $checkMailExistQuery->execute(["email"=>$mail]);
    $checkMailExist = $checkMailExistQuery->fetch();

    if($checkMailExist){
        $checkChangePwdStatusQuery = $db->prepare("SELECT changePassword FROM RkU_USER WHERE email=:email");
        $checkChangePwdStatusQuery->execute(['email'=>$mail]);
        $changePwdStatus = $checkChangePwdStatusQuery->fetch()[0];

        if($changePwdStatus == 0){
            $pwdclear = uniqidReal(16) . '$' . time()%13;

            $src = 'https://pa-atw.fr/sources/img/logo.png';
            $to = $mail;
            $subject = 'Nouveau mot de passe Fitness Essential 💪';
            $message = "<html><section><h1>Identifiants Fitness Essential</h1><img src=' . $src . ' alt='logo'><ul><li>Email : $mail</li><li>Mot de passe : $pwdclear</li></ul></section></html>";
            $headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
            $headers .= "MIME-Version: 1.0" . PHP_EOL;
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            if(mail($to,$subject, $message, $headers)) {
                $newPwd = password_hash($pwdclear, PASSWORD_DEFAULT);
                $changePwdQuery = $db->prepare("UPDATE RkU_USER SET password=:password, changePassword = 1 WHERE email=:email");
                $changePwdQuery->execute([
                    'password'=>$newPwd,
                    'email'=>$mail
                ]);
            }else{
                setMessage('newPassword', ['Nous sommes désolés, notre serveur n\'a pas réussi à envoyé le mail, Veuillez réessayer ultérieurement'], 'warning');
                header('Location: ../vues/passwordForgotten.php');
                die();
            }
        }
    }
}else{
    setMessage('newPassword', $verifMail[1], 'warning');
    header('Location: ../../../index.php');
    die();
}

setMessage('newPassword', ['Si un compte a été crée avec cette adresse mail, vous recevrez un mail de réinitialisation du mot de passe'], 'info');
header('Location: ../../../index.php');
die();