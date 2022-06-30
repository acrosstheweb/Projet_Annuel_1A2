<?php
require_once 'functions.php';

$filePath = ABSOLUTE_PATH . "sources/captcha/tileNumber.txt";
$fileTileNumber = fopen($filePath, 'r');
$tileLength = (int)fread($fileTileNumber, filesize($filePath));
fclose($fileTileNumber);

$captchas = glob(ABSOLUTE_PATH . 'sources/captcha/captcha?????????.{jpg,jpeg,png}', GLOB_BRACE);
$filename = $captchas[array_rand($captchas)];

$explodedFile = explode('.', $filename);
$extension = strtolower($explodedFile[1]);

$imageName = explode('captcha/captcha', $filename)[1];
$imageId = explode('.', $imageName)[0];

if($extension == 'jpeg' || $extension == 'jpg'){
    $captchaImage = imagecreatefromjpeg($filename);
}
else if($extension == 'png'){
    $captchaImage = imagecreatefrompng($filename);
}

list($width, $height) = getimagesize($filename);

$pathArray = [];
$tileId = 0;
$combinaison = []; // Tableau qui contient le bon ordre de résolution du captcha
for ($i=0;$i<$tileLength**2;$i++){
    $combinaison[] = uniqidreal(4);
}


for ($i = 0; $i < $tileLength; $i++){
    for ($j = 0; $j < $tileLength; $j++){
        $dst_image = imagecreatetruecolor($width / $tileLength, $height / $tileLength);
        imagecopy($dst_image, $captchaImage, 0, 0, $width / $tileLength * $j, $height / $tileLength * $i, $width / $tileLength, $height / $tileLength);

        if($extension == 'jpeg' || $extension == 'jpg') {
            imagejpeg($dst_image, ABSOLUTE_PATH . "sources/captcha/" . $imageId . "-" . $i . "_" . $j . ".jpeg");
        }else if($extension == 'png'){
            imagepng($dst_image, ABSOLUTE_PATH . "sources/captcha/" . $imageId . "-" . $i . "_" . $j . ".jpeg");
        }
        $pathArray[$combinaison[$tileId]] = [$tileId, "sources/captcha/" . $imageId . "-".$i."_".$j.".jpeg"];
        $tileId++;
    }
}

$_SESSION['captcha'] = $combinaison;
shuffle($combinaison);

?>

<div class="container-fluid" id="__captcha" data-tiles="<?= $tileLength ?>">
    <?php
    $cpt = 0;
    for ($i = 0; $i < $tileLength; $i++){
        echo '<div class="row">';
        for ($j = 0; $j < $tileLength; $j++){
            ?>
            <div id="__captchaTile<?= $cpt ?>" class="col p-1">
                <img class="img-fluid float-start" src="<?php echo DOMAIN . $pathArray[$combinaison[$cpt]][1] ?>" alt="">
                <input type="hidden"
                       id="__tile<?= $cpt ?>"
                       name="__tile<?= $cpt ?>"
                       value="<?= $combinaison[$cpt] ?>">
            </div>
            <?php
            $cpt++;
        }
        echo '</div>';
    }
    ?>
</div>

<script src="<?= DOMAIN . 'js/captcha.js'?>" crossorigin="anonymous"></script>