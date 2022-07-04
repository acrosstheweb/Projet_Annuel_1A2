<?php

require '../../../../functions.php';

if (!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

if(isset($_GET['id'])){

    $fileName = htmlspecialchars(trim($_GET['id']));
    unlink(ABSOLUTE_PATH . 'sources/captcha/' . $fileName);

    setMessage('captchaDelete', ['Captcha supprimé'], 'success');
    header('Location: ../../vues/admin/captchaAdmin.php');

}else{
    header('../../../../error404.php');
}
die();