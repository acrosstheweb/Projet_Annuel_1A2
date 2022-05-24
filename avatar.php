<?php
$title = "Fitness Essential - Avatar";
$content = "Création avatar";
require 'header.php';
?>

    <h2 class="aligned-title"> Création avatar </h2>

    <div align="center">
        <span id="__switch-left">G</span>
        <img src="sources/avatar/background-01.png">
        <span id="__switch-right">D</span>
        <br><br>
        <div>
            <?php
                $avatar_files = glob("sources/avatar/*.png");
                foreach($avatar_files as $image){
                    echo "<img src='$image' width='64' height='64' style='border:1px solid black;cursor:pointer;margin:5px;'>";
                }
            ?>
        </div>

    </div>

<?php
include 'footer.php';
?>