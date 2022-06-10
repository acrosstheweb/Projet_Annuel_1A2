<?php
require_once 'functions.php';

$filename = "sources/captcha/1.jpg";

$captchaImage = imagecreatefromjpeg($filename);
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

        imagejpeg($dst_image, "sources/captcha/1-".$i."_".$j.".jpeg");

        // array_push($pathArray, [$tileId, "sources/captcha/1-".$i."_".$j.".jpeg"]);
        $pathArray[$combinaison[$tileId]] = [$tileId, "sources/captcha/1-".$i."_".$j.".jpeg"];
        $tileId++;
    }
}
// echo '<pre>';
// var_dump($combinaison);
// echo '<Br>';
// var_dump($pathArray);
$_SESSION['captcha'] = $combinaison;
shuffle($combinaison);
// echo '<pre>';
// var_dump($pathArray);
?>

<div class="container-fluid" style="max-width: 660px">
    <!--<form id="verifyCaptcha" method="POST" action="<?/*= DOMAIN . 'verifyCaptcha.php'*/?>">-->
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
    <!--</form>-->
    <!--<button type="submit" form="verifyCaptcha" class="btn btn-primary mt-5" id="__captchaSubmit">Valider</button>-->
</div>

<script src="<?= DOMAIN . 'js/captcha.js'?>" crossorigin="anonymous"></script>