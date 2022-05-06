<?php
    if(!empty($_FILES['file'])){
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

        var_dump($_FILES);

    $extensionsAllowed = ['png', 'jpg', 'jpeg'];

    $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];

    $explodedFile = explode('.', $name);
    $extension = $explodedFile[1];
    $maxSize = 900000;


    $imgId = uniqid();

    $tempFile = 'temp'.$imgId.'.'.strtolower($extension);
    move_uploaded_file($tmpName, './tmpUpload/'.$tempFile);

    $logo = imagecreatefrompng('sources/img/logo.png');

    $sizeLogo = filesize('sources/img/logo.png');

    if(in_array($type, $typeImage)){
        if(count($explodedFile) <=2 && in_array(strtolower($extension), $extensionsAllowed)){
            if($size + $sizeLogo <= $maxSize){

                // Traitement ajoute du filigrane

                // var_dump($extension);

                if($extension == 'jpeg' || $extension == 'jpg'){
                    $image = imagecreatefromjpeg('./tmpUpload/'.$tempFile);
                }
                else if($extension == 'png'){ // seul le format png peut passer dans le else
                    $image = imagecreatefrompng('./tmpUpload/'.$tempFile);
                }

                
                $marge_right = 10;
                $marge_bottom = 10;

                $imageWidth = imagesx($image);
                $imageHeight = imagesy($image);

                $logoScale = imagescale($logo, $imageWidth/2, $imageHeight/2, IMG_BILINEAR_FIXED);

                $logoWidth = imagesx($logo);
                $logoHeight = imagesy($logo);

                $centerX=round(($imageWidth/2) - $logoWidth/2);
                $centerY=round(($imageHeight/2) - $logoHeight/2);

                // header('Content-type: image/jpeg');
                
                // imagedestroy($image);

                if(imagecopy($image, $logo, $centerX, $centerY, 0, 0, $logoWidth, $logoHeight)){ //On garde une trace des fichiers temporaires dans un dossier pour de la journalisation ou en cas d'injection de code malveillant à travers un fichier qui pourrait passer

                    imagepng($image, './uploadFiles/fili'.$imgId.'.'.strtolower($extension));
                    echo 'Le fichier a bien été uploadé';
                    var_dump($image, 
                    $logoWidth,
                    $logoHeight,
                    $imageWidth,
                    $imageHeight,
                    $centerX,
                    $centerY,
                    $logoWidth,
                    $logoHeight);
                }
                else{
                    unlink('./tmpUpload/'.$tempFile);
                    echo 'Le fichier n\'a pas pu être uploadé';
                }
            }
            else
                echo 'Fichier trop lourd ou format incorrect';
        }
        else
            echo 'Extension Incorrecte';
    }
    else
        echo 'Type non autorisé';
    }
    else{
        setMessage('Register', 'Impossible', 'warning');
        header('Location: index.php');
        die();
    }

    
// // Création des instances d'image
// $src = imagecreatefromjpeg('./tmpUpload/'.$tempFile);
// $dest = imagecreatetruecolor(80, 40);

// // Copie
// imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);

// // Affichage et libération de la mémoire
// header('Content-Type: image/jpeg');
// imagegif($dest);

// imagedestroy($dest);
// imagedestroy($src);


?>