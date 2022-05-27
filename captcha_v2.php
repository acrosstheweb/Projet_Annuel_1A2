<?php 

$filename = "sources/captcha/1.jpg";

$captchaImage = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$pathArray = [];

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 3; $j++){
        $dst_image = imagecreatetruecolor($width / 3, $height / 3);
        imagecopy($dst_image, $captchaImage, 0, 0, $width / 3 * $j, $height / 3 * $i, $width / 3, $height / 3);

        imagejpeg($dst_image, "sources/captcha/1-".$i."_".$j.".jpeg");

        array_push($pathArray, "sources/captcha/1-".$i."_".$j.".jpeg");
    }
}

shuffle($pathArray);

foreach ($pathArray as $path){
    echo '<img style="width: 200px; height: auto; margin: 2px;" src='.$path.'>';
}




?>



<!-- 

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</div> -->