<?php
    require '../../../functions.php';

    if(
        count($_POST) != 5 ||
        empty($_POST['__avatarBackground']) ||
        empty($_POST['__avatarColor']) ||
        empty($_POST['__avatarEyes']) ||
        empty($_POST['__avatarNose']) ||
        !isset($_POST['__avatarGlasses'])
    ){
        setMessage('RegisterHack', ['Non respect des règles du formulaire de création d\'avatar'],'danger');
        header('Location: ../../../error404.php');
        die();
    }

    $fileName = substr($_POST['__avatarBackground'], -6, 2);
    $fileName .= substr($_POST['__avatarColor'], -10, 6);
    $fileName .= substr($_POST['__avatarEyes'], -10, 6);
    $fileName .= substr($_POST['__avatarNose'], -7, 3);
    if (isset($_POST['__avatarGlasses'])){  
        $fileName .= substr($_POST['__avatarGlasses'], -10, 6);
    }
    $fileName .= '.png';

    $id = $_SESSION['userId'];


    if (!(in_array($fileName, glob("sources/avatar/*.png")))){
        $background = imagecreatefrompng(ABSOLUTE_PATH . 'sources\avatar\__' . $_POST['__avatarBackground']);
        $face = imagecreatefrompng(ABSOLUTE_PATH . 'sources\avatar\__' . $_POST['__avatarColor']);
        $eyes = imagecreatefrompng(ABSOLUTE_PATH . 'sources\avatar\__' . $_POST['__avatarEyes']);
        $nose = imagecreatefrompng(ABSOLUTE_PATH . 'sources\avatar\__' . $_POST['__avatarNose']);
        if (isset($_POST['__avatarGlasses'])){
            $glasses = imagecreatefrompng(ABSOLUTE_PATH . 'sources\avatar\__' . $_POST['__avatarGlasses']);
        }

        $imageWidth = imagesx($background);
        $imageHeight = imagesy($background);
        $face = imagescale($face, $imageWidth, $imageHeight, IMG_BILINEAR_FIXED);
        imagecopy($background, $face, 0, 0, 0, 0, $imageWidth, $imageHeight);

        $imageWidth = imagesx($background);
        $imageHeight = imagesy($background);
        $eyes = imagescale($eyes, $imageWidth, $imageHeight, IMG_BILINEAR_FIXED);
        imagecopy($background, $eyes, 0, 0, 0, 0, $imageWidth, $imageHeight);

        $imageWidth = imagesx($background);
        $imageHeight = imagesy($background);
        $nose = imagescale($nose, $imageWidth, $imageHeight, IMG_BILINEAR_FIXED);
        imagecopy($background, $nose, 0, 0, 0, 0, $imageWidth, $imageHeight);

        if (isset($_POST['__avatarGlasses'])){
            $imageWidth = imagesx($background);
            $imageHeight = imagesy($background);
            $glasses = imagescale($glasses, $imageWidth, $imageHeight, IMG_BILINEAR_FIXED);
            imagecopy($background, $glasses, 0, 0, 0, 0, $imageWidth, $imageHeight);
        }

        imagepng($background, 'sources/avatar/finished/' . $fileName);
    }

    $db = database();
    $insertUserQuery = $db->prepare("UPDATE RkU_USER SET 
                                            avatar = :avatar
                                            WHERE id=:id");

    $insertUserQuery->execute([
        'avatar' => $fileName,
        'id' => $id
    ]);

    setMessage('Update', ['Mise à jour de l\'avatar réussie !'], 'success');
    header('Location: ' . DOMAIN . 'modules/user/vues/profilePage.php');
    die();
    
    