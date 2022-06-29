<?php

require '../../../../functions.php';

if (!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

if(isset($_POST['captcha-images-form'])){

    if(!empty($_FILES['captcha-image'])) {
        $name = $_FILES['captcha-image']['name'];
        $type = $_FILES['captcha-image']['type'];
        $size = $_FILES['captcha-image']['size'];
        $tmpName = $_FILES['captcha-image']['tmp_name'];
        $error = $_FILES['captcha-image']['error'];

        $extensionsAllowed = ['png', 'jpg', 'jpeg'];

        $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];

        $explodedFile = explode('.', $name);
        $extension = strtolower($explodedFile[1]);

        $imgId = uniqid();

        $tempFile = 'temp' . $imgId . '.' . $extension;

        if (count($explodedFile) <= 2 && in_array($extension, $extensionsAllowed)) {
            if (in_array($type, $typeImage)) {
                if ($size <= 1000000) { // 1000000 Bytes = 1Mo
                    $tmpId = uniqidReal(9);
                    move_uploaded_file($tmpName, ABSOLUTE_PATH . '/sources/captcha/captcha' . $tmpId . '.' . $extension); // On déplace le fichier dans le dossier tmpUpload
                    setMessage('captchaModify', ['Upload Réussi !'], 'success');
                } else {
                    setMessage('captchaModify', ['Upload impossible, le fichier doit peser au maximum 1 Mo'], 'warning');
                }
                header('Location: ../../vues/admin/captchaAdmin.php');
                die();
            } else {
                setMessage('captchaModify', ['Type de fichier interdit, vous devez utiliser un fichier .png, .jpg ou .jpeg'], 'warning');
                header('Location: ../../vues/admin/captchaAdmin.php');
                die();
            }
        } else {
            setMessage('captchaModify', ['Extension Incorrecte, Le fichier téléversé doit être sous forme x.png ou x.jpg ou x.jpeg'], 'warning');
            header('Location: ../../vues/admin/captchaAdmin.php');
            die();
        }
    }else{
        setMessage('captchaModify', ['Impossible d\'uploader l\'image veuillez contacter un administrateur'], 'warning');
        header('Location: ../../vues/admin/captchaAdmin.php');
        die();
    }

}
elseif(isset($_POST['captcha-pieces-form'])){

    if(!empty($_POST['captcha-pieces'])){
        $pieces = $_POST['captcha-pieces'];
        if(ctype_digit($pieces)){
            try{
                $txtName = ABSOLUTE_PATH . "sources/captcha/tileNumber.txt";
                if(!file_exists($txtName)){ throw new Exception('Impossible d\'enregistrer la valeur : Fichier txt non trouvé'); }

                $tileFile = fopen($txtName, "w"); // Fichier qui contient le nombre de pièces découpant le captcha
                if(!$tileFile){ throw new Exception('Impossible d\'enregistrer la valeur : Erreur lors de l\'ouverture du fichier txt'); }

                fwrite($tileFile, $pieces); // on donne un nombre de coté divisant en long et en large le captcha qui est un carré de pièces
                fclose($tileFile);
            }catch(Exception $e){
                setMessage('captchaModify', [$e], 'warning');
                header('Location: ../../vues/admin/captchaAdmin.php');
                die();
            }
            setMessage('captchaModify', ["Enregistré !"], 'success');
        }else{
            setMessage('captchaModify', ['Il faut entrer un chiffre pas autre chose'], 'danger');
        }
        header('Location: ../../vues/admin/captchaAdmin.php');
        die();
    }else{
        setMessage('captchaModify', ['?'], 'danger');
        header('Location: ../../vues/admin/captchaAdmin.php');
        die();
    }

}else{
    header('../../../../error404.php');
    die();
}