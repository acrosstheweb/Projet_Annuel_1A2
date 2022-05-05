<?php
    if(!empty($_FILES['file'])){
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

    $extensionsAllowed = ['png', 'jpg', 'jpeg', 'gif'];

    $typeImage = ['image/png', 'image/jpg', 'image/jpeg', 'image.gif'];

    $extension = explode('.', $name);
    $maxSize = 900000;


    $tempFile = 'temp.'.strtolower(end($extension));
    move_uploaded_file($tmpName, './tmpUpload/'.$tempFile);

    $logo = imagecreatefrompng('sources/img/logo.png');
    $sizeLogo = filesize('sources/img/logo.png');

    if(in_array($type, $typeImage)){
        if(count($extension) <=2 && in_array(strtolower(end($extension)), $extensionsAllowed)){
            if($size + $sizeLogo <= $maxSize){

                // Traitement ajoute du filigrane
            $image = imagecreatefromjpeg('./tmpUpload/'.$tempFile);

            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($logo);
            $sy = imagesy($logo);

            $imagex = imagesx($image);
            $imagey = imagesy($image);
            $centerX=round($imagex/2);
            $centerY=round($imagey/2);

            imagecopy($image, $logo, //$centerX, $centerY, $centerX, $centerY, $sx, $sy);
            


            // header('Content-type: image/jpeg');
            //imagepng($image);
            //imagedestroy($image);

                if(rename('./tmpUpload/'.$tempFile, './uploadFiles/'.uniqid().'.'.strtolower(end($extension)))){
                    //unlink('./tmpUpload/'.$tempFile);
                    echo 'Le fichier a bien été uploadé';
                    var_dump($image, 
                    $sx,
                    $sy,
                    $imagex,
                    $imagey,
                    $centerX,
                    $centerY,
                    imagesx($logo),
                    imagesy($logo));
                }
                else{
                    //unlink('./tmpUpload/'.$tempFile);
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
