<?php
require_once 'functions.php';


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
for ($i=0;$i<9;$i++){
    $combinaison[] = uniqidreal(4);
}

shuffle($combinaison);

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 3; $j++){
        $dst_image = imagecreatetruecolor($width / 3, $height / 3);
        imagecopy($dst_image, $captchaImage, 0, 0, $width / 3 * $j, $height / 3 * $i, $width / 3, $height / 3);

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

<div class="container-fluid" id="__captcha">
        <?php
            for ($i = 0; $i < 9; $i++){
                if ($i % 3 == 0){
                    echo '<div class="row">';
                }
        ?>
            <div id="__captchaTile<?php  echo $i ?>" class="col-4 p-1">
                    <img class="img-fluid float-start" src="<?php echo DOMAIN . $pathArray[$combinaison[$i]][1] ?>" alt="">
                    <input type="hidden" 
                            id="__tile<?php echo $i ?>"
                            name="__tile<?php echo $i ?>"
                            value="<?php echo $combinaison[$i] ?>">
            </div> 
        <?php
                if ($i % 3 == 2){
                    echo '</div>';
                }
            }
        ?>
</div>

<script src="<?= DOMAIN . 'js/captcha.js'?>" crossorigin="anonymous"></script>