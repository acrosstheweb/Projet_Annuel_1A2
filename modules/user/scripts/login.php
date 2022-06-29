<?php
require '../../../functions.php';

$post_variables = (isset($_POST['login-remember'])) ? 3 : 2;
if(

    count($_POST) != $post_variables ||
    empty($_POST['login-email']) ||
    empty($_POST['login-password'])

){

    setMessage('LoginHack', ['Non respect des règles du formulaire de connexion'],'danger');
    header('Location: ../../../error404.php');
    die();

}

$email = strtolower(trim($_POST['login-email']));
$password = $_POST['login-password'];

$problems = [];
$db = database();

$checkUserQuery = $db->prepare('SELECT id, password, changePassword,role FROM RkU_USER WHERE email=:email');
$checkUserQuery->execute([':email'=>$email]);
$user = $checkUserQuery->fetch();

if($user === false){

    $userExist = false;
    setMessage('Connection', ['Nom d\'utilisateur ou mot de passe incorrect'], 'warning');

}else{

    $userExist = true;
    $pwdInDb = $user['password'];

    if(password_verify($password, $pwdInDb)){
        if($user['role'] < 1){
            setMessage('Connection', ['Vous n\'avez pas confirmé votre compte via le mail envoyé :)'], 'info');
        }else{
            if(isset($_POST['login-remember'])){ // Se souvenir de moi pendant 7 jours
                setcookie('FitEssMail', $email, time()+3600*24*30, '/', null, false, false);
                $protectedPwdForCookie = openssl_encrypt($pwdInDb, "AES-256-CTR", '$pa-cle-encryption-atw$');
                setcookie('FitEssPass', $protectedPwdForCookie, time()+3600*24*30, '/', null, false, false);
            }
            $msg = 'Connexion réussie';
            if($user['changePassword'] == 1){
                $changePwdQuery = $db->prepare('UPDATE RkU_USER SET changePassword = 0 WHERE id=:id');
                $changePwdQuery->execute(['id'=>$user['id']]);
                $msg = 'Connexion réussie, nous vous conseillons de modifier le mot de passe par défaut que nous avons crée.';
            }
            $_SESSION['userToken'] = setToken($user['id']);
            $_SESSION['userId'] = $user['id'];
            setMessage('Connection', [$msg], 'success');
            atw_log($user['id'], "Connexion");
        }
    }else{
        setMessage('Connection', ['Nom d\'utilisateur ou mot de passe incorrect'], 'warning');
    }

}
header('Location: ../../../index.php');
die();