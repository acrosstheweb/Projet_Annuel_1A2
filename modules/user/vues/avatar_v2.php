<?php
$title = "Fitness Essential - Avatar";
$content = "Création avatar";
require '../../../header.php';
?>

    <h1 class="aligned-title"> Création avatar </h1>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <div class="col-10 col-lg-3">
                <div class="cont">
                <form id="__avatar" method="POST" action="<?= DOMAIN . 'modules/user/scripts/addAvatar.php' ?>">
                    <div class="__avatarPreviewContainer d-flex justify-content-center">
                        <img id="__avatarPreview" src="<?= DOMAIN .'sources/avatar/__empty.png'?>" class="img-fluid __avatarPreview" alt="">
                        <img id="__avatarBackgroundPreview" src="" class="img-fluid __avatarPreview" alt="">
                        <input type="hidden" 
                            id="__avatarBackground"
                            name="__avatarBackground">

                        <img id="__avatarFacePreview" src="" class="img-fluid __avatarPreview" alt="">

                        <img id="__avatarColorPreview" src="" class="img-fluid __avatarPreview" alt="">
                        <input type="hidden" 
                            id="__avatarColor"
                            name="__avatarColor"
                            require="required">
            
                        <img id="__avatarEyesPreview" src="" class="img-fluid __avatarPreview" alt="">
                        <input type="hidden" 
                            id="__avatarEyes"
                            name="__avatarEyes"
                            require="required">
            
                        <img id="__avatarNosePreview" src="" class="img-fluid __avatarPreview" alt="">
                        <input type="hidden" 
                            id="__avatarNose"
                            name="__avatarNose"
                            require="required">
            
                        <img id="__avatarGlassesPreview" src="" class="img-fluid __avatarPreview" alt="">
                        <input type="hidden" 
                            id="__avatarGlasses"
                            name="__avatarGlasses">
                    </div>
                </form>
                </div>
            </div>

            <div class="col-1"></div>

            <div class="col-10 col-lg-5">
                <div class="row __avatarChoiceRow">
                    <h2>Choix de la couleur de fond</h2>
                    <?php
                        $avatarBackground_files = glob("../../../sources/avatar/__background-*.png");
                        foreach($avatarBackground_files as $backgroundImage){
                            $backgroundImage = explode('/', $backgroundImage);
                            echo "<img src=" . DOMAIN . "sources/avatar/" . end($backgroundImage). " class='img-fluid __avatarChoice' alt='' onclick='displayBackground(this.src)'>";
                        }
                    ?>
                </div>
                <div class="row __avatarChoiceRow">
                    <h2>Choix de la forme du visage</h2>
                    <?php
                        $avatarFace_files = glob("../../../sources/avatar/__visage-??.png");
                        foreach($avatarFace_files as $faceImage){
                            $faceImage = explode('/', $faceImage);
                            echo "<img src=". DOMAIN . "sources/avatar/" . end($faceImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayFace(this.src)'>";
                        }
                    ?>
                </div>
                <div class="row __avatarChoiceRow">
                    <h2 id="__avatarFacesTitle" class="d-none">Choix de la couleur de peau</h2>
                    <div class="row px-0 d-none" id="__avatarRoundFaces">
                        <?php
                            $avatarRound_files = glob("../../../sources/avatar/__visage-01-*.png");
                            foreach($avatarRound_files as $roundImage){
                                $roundImage = explode('/', $roundImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($roundImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayColor(this.src)'>";
                            }
                        ?>
                    </div>
                    <div class="row px-0 d-none" id="__avatarDiamondFaces">
                        <?php
                            $avatarDiamond_files = glob("../../../sources/avatar/__visage-02-*.png");
                            foreach($avatarDiamond_files as $diamondImage){
                                $diamondImage = explode('/', $diamondImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($diamondImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayColor(this.src)'>";
                            }
                        ?>
                    </div>
                    <div class="row px-0 d-none" id="__avatarSquareFaces">
                        <?php
                            $avatarSquare_files = glob("../../../sources/avatar/__visage-03-*.png");
                            foreach($avatarSquare_files as $squareImage){
                                $squareImage = explode('/', $squareImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($squareImage). " class='img-fluid __avatarChoice' alt='' onclick='displayColor(this.src)'>";
                            }
                        ?>
                    </div>
                </div>
                <div class="row __avatarChoiceRow">
                    <h2>Choix des yeux</h2>
                    <div id="__avatarEyesChoices" class="row px-0">
                        <?php
                            $avatarEyes_files = glob("../../../sources/avatar/__yeux-01-*.png");
                            foreach($avatarEyes_files as $eyesImage){
                                $eyesImage = explode('/', $eyesImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($eyesImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayEyes(this.src); showGlasses()'>";
                            }
                        ?>
                    </div>
                    <div id="__avatarEyeChoices" class="row px-0">
                        <?php
                            $avatarEye_files = glob("../../../sources/avatar/__yeux-02*.png");
                            foreach($avatarEye_files as $eyeImage){
                                $eyeImage = explode('/', $eyeImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($eyeImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayEyes(this.src); showMonocles()'>";
                            }
                        ?>
                    </div>
                </div>
                <div class="row __avatarChoiceRow">
                    <h2>Choix du nez</h2>
                    <?php
                        $avatarNose_files = glob("../../../sources/avatar/__nez-*.png");
                        foreach($avatarNose_files as $noseImage){
                            $noseImage = explode('/', $noseImage);
                            echo "<img src=". DOMAIN . "sources/avatar/" . end($noseImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayNose(this.src)'>";
                        }
                    ?>
                </div>
                <div class="row __avatarChoiceRow">
                    <h2>Choix des lunettes</h2>
                    <div id="__avatarGlassesChoices" class="row px-0">
                        <img src="<?= DOMAIN . 'sources/avatar/__delete.png'?>" class='img-fluid __avatarChoice' alt='' onclick='emptyGlasses()'>
                        <?php
                            $avatarGlasses_files = glob("../../../sources/avatar/__lunettes-01-*.png");
                            foreach($avatarGlasses_files as $glassesImage){
                                $glassesImage = explode('/', $glassesImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($glassesImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayGlasses(this.src)'>";
                            }
                        ?>
                    </div>
                    <div id="__avatarMonoclesChoices" class="row px-0">
                        <img src="<?= DOMAIN . 'sources/avatar/__delete.png'?>" class='img-fluid __avatarChoice' alt='' onclick='emptyGlasses()'>
                        <?php
                            $avatarGlasses_files = glob("../../../sources/avatar/__lunettes-02-*.png");
                            foreach($avatarGlasses_files as $glassesImage){
                                $glassesImage = explode('/', $glassesImage);
                                echo "<img src=". DOMAIN . "sources/avatar/" . end($glassesImage) . " class='img-fluid __avatarChoice' alt='' onclick='displayGlasses(this.src)'>";
                            }
                        ?>
                    </div>
                </div>
            </div>
                        
            
        </div>
        
        <div class="d-flex justify-content-center">
            <button type="submit" form="__avatar" class="btn btn-primary mt-5" id="__avatarSubmit">Valider</button>
        </div>
    </div>

<script src="<?= DOMAIN . 'js/avatar.js'?>" crossorigin="anonymous"></script>

<?php
include '../../../footer.php';
