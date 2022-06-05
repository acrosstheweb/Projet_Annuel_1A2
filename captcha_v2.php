<?php
require "header.php";

$filename = "sources/captcha/1.jpg";

$captchaImage = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$pathArray = [];
$tileId = 0;
$numbers = [0,1,2,3,4,5,6,7,8];

shuffle($numbers);

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 3; $j++){
        $dst_image = imagecreatetruecolor($width / 3, $height / 3);
        imagecopy($dst_image, $captchaImage, 0, 0, $width / 3 * $j, $height / 3 * $i, $width / 3, $height / 3);

        imagejpeg($dst_image, "sources/captcha/1-".$i."_".$j.".jpeg");

        // array_push($pathArray, [$tileId, "sources/captcha/1-".$i."_".$j.".jpeg"]);
        $pathArray[$numbers[$tileId]] = [$tileId, "sources/captcha/1-".$i."_".$j.".jpeg"];
        $tileId++;
    }
}
echo '<pre>';
var_dump($numbers);
$_SESSION['captcha'] = $numbers;
// shuffle($pathArray);
// echo '<br>';
var_dump($pathArray);
?>

<div class="container-fluid col-11 col-md-8 col-lg-6">
    <form id="verifyCaptcha" method="POST" action="verifyCaptcha.php"></form>
    <?php 
        for ($i = 0; $i < 9; $i++){ 
            if ($i % 3 == 0){
                echo '<div class="row">';
            }
    ?>
        <div id="__captchaTile<?php  echo $i ?>" class="col-4 p-1">
            <input type="image" class="img-fluid" id="__tile<?php echo $pathArray[$numbers[$i]][0] ?>" src="<?php echo DOMAIN . $pathArray[$i][1] ?>" value="<?php echo $pathArray[$numbers[$i]][0] ?>">
        </div> 
    <?php
            if ($i % 3 == 2){
                echo '</div>';
            }
        }
    ?>
    <button form="verifyCaptcha" class="btn btn-primary mt-5" id="__captchaSubmit">Valider</button>
</div>
<?php
    var_dump($_SESSION);
?>

<script src="<?= DOMAIN . 'js/captcha.js'?>" crossorigin="anonymous"></script>