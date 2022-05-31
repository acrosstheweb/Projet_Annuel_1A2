<?php
$title = "Fitness Essential - Avatar";
$content = "Création avatar";
require 'header.php';
?>

    <h2 class="aligned-title"> Création avatar </h2>

    <div align="center">
        <span id="__switch-left">G</span>
            <img id="__preview-avatar" src="<?= DOMAIN . 'sources/img/avatar.jpg'?>" width="128" height="128">
        <span id="__switch-right">D</span>
        <br><br>
        <div id="__elements-avatar">
            <?php
                $avatar_files = glob("sources/avatar/*.png");
                foreach($avatar_files as $image){
                    echo "<img src=". DOMAIN . $image." width='64' height='64' style='border:1px solid black;cursor:pointer;margin:5px;' onclick='displayIt(this.src)'>";
                }
            ?>
            <div id="__backgrounds-avatar"></div>
            <div id="__visages-avatar"></div>
            <div id="__yeux-avatar"></div>
        </div>
    </div>

    <script type="text/javascript" crossorigin="anonymous">

        const avatar = []; // Tableau qui va contenir : Visage = x, Yeux = y, ...



        function displayIt(src){
            document.getElementById("__preview-avatar").setAttribute('src', src);
            const elementType = src.split('__')[1];
            avatar.push(elementType);
            console.log(`avatar = ${avatar}`);
        }
        const elements = document.querySelector("div#__elements-avatar").children;
        for(const element of elements){
            const src = element.currentSrc;
            const elementType = src.split('__')[1]; // Determine quel type d'élement de l'avatar est itéré (visage, yeux, ...)
            console.log(elementType);
        }
        console.log(elements);
    </script>

<?php
include 'footer.php';
