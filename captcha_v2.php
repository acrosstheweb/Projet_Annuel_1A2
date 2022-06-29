<?php 

require "header.php";

$filename = "sources/captcha/1.jpg";

$captchaImage = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$pathArray = [];
$tileId = 0;

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 3; $j++){
        $dst_image = imagecreatetruecolor($width / 3, $height / 3);
        imagecopy($dst_image, $captchaImage, 0, 0, $width / 3 * $j, $height / 3 * $i, $width / 3, $height / 3);

        imagejpeg($dst_image, "sources/captcha/1-".$i."_".$j.".jpeg");

        array_push($pathArray, [$tileId, "sources/captcha/1-".$i."_".$j.".jpeg"]);
        $tileId++;
    }
}

shuffle($pathArray);

?>

<div class="container-fluid" style="width: 600px;">
    <?php 
        for ($i = 0; $i < 9; $i++){ 
            if ($i % 3 == 0){
                echo '<div class="row">';
            }
    ?>
        <div id="__captchaTile<?php  echo $i ?>" class="col-4 p-1">
            <img class="img-fluid" id="__tile<?php echo $pathArray[$i][0] ?>" src="<?php echo $pathArray[$i][1] ?>">
        </div> 
    <?php
            if ($i % 3 == 2){
                echo '</div>';
            }
        }
    ?>
</div>

<script src="js/captcha.js" crossorigin="anonymous"></script>