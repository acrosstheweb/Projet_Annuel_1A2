<?php
if(isset($_SESSION)){
    session_destroy();
}
session_start();

$image = imagecreate(300,150);

$backR = rand(128,255);
$backG = rand(128,255);
$backB = rand(128,255);
$back = imagecolorallocate($image, $backR, $backG, $backB);

$red = imagecolorallocate($image, 255, 0, 0);

$fonts = [];
$absolutePath = getcwd();
foreach (scandir('sources/fonts/') as $key => $file) {
    if(strpos($file, '.ttf')){ // Si le nom du fichier dans dossier fonts contient ".ttf"
        array_push($fonts, $absolutePath.'\sources\fonts\\'.$file); // Ajouter le fichier .ttf au tableau $font
    }
}

$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
$captcha = substr(str_shuffle($chars), 0, rand(6,8));


$posx = rand(5,20);
$posy = rand(30,120);
$randomPickedColors = [];

foreach (str_split($captcha) as $key => $captchaChar) {
    $fontSize = rand(25,30);
    ($posx>=260) ? $posx-=$fontSize : $posx+=rand(30,35);
    // ($posy>=120 || $posy<=30) ? $posy=rand(30,120): $posy+=rand(-40,40); // Si la position en y du prochain caractère est supérieure à 150px ou inférieure à 45px alors rechoisir entre 30 et 150
    $posy = rand(30,120);

    // Texte
    $textR = rand(0,128);
    $textG = rand(0,128);
    $textB = rand(0,128);

    $textColor = imagecolorallocate($image, $textR, $textG, $textB);
    array_push($randomPickedColors, $textColor); // Ajoute une couleur d'un charactère pour pouvoir être utilisé par les formes plus tard

    imagettftext($image, $fontSize, rand(-30,30), $posx, $posy, $textColor, $fonts[array_rand($fonts)], $captchaChar);

    // Formes
    $roll = rand(0,5);
    if($roll == 1){
        imageellipse($image, $posx, $posy, rand(35,75), rand(35,75), $randomPickedColors[array_rand($randomPickedColors)]);
    }elseif($roll == 2){
        imagerectangle($image, $posx+rand(-25,25), $posy+rand(-15,15), $posx+rand(-75,75), $posy+rand(-45,45), $randomPickedColors[array_rand($randomPickedColors)]);
    }elseif($roll == 3){
        imagearc($image, $posx, $posy, rand(25,65), rand(15,45), rand(-45,45), rand(-45,45), $randomPickedColors[array_rand($randomPickedColors)]);
    }

}

header("Content-Type: image/png");
$_SESSION['captcha'] = $captcha;

imagestring($image, 5, 220, 130, $captcha, $red);
imagepng($image); // Affiche l'image dans le navigateur
// imagepng($image, 'captcha.png'); // Enregistre l'image en tant que "captcha.png" dans le dossier dans lequel le script php executé
imagedestroy($image);