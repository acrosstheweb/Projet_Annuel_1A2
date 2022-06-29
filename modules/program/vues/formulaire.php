<?php
$title = "Fitness Essential - Créer un programme";
$content = "Création d'un programme";
$currentPage = 'message';
require '../../../header.php';

$pdo = database();

    $req = $pdo->query("SELECT id, nameExercice
                        FROM RkU_EXERCICE
                        ORDER BY nameExercice ASC
                        ");

    $results = $req->fetchAll();
?>

<h1 class="aligned-title">Création d'un programme d'entraînement</h1>

<div class="row d-flex justify-content-center">
    <div class="col-10 col-lg-7 d-flex justify-content-center">
        <form id="__programAddForm" action="../scripts/newProgram.php" method="POST" enctype ="multipart/form-data" class="col-10 my-3">
            <div class="row my-3">
                <label for="__programTitle">Nom du rogramme : </label>
                <input class="form-control" type="text" name="programTitle" id="__programTitle" placeholder="Pull #2" oninput="displayProgramTitle()"><br>
            </div>

            <div class="row my-3">
                <label for="__programFile">Illustration : </label>
                <input type="file" name="programFile" id="__programFile" required="required">
            </div>

            <div id="__programExerciceList" class="accordion" >

                <div id="__programExercice1" class="__programExercice accordion-item">
                    <div class="row">
                        <label for="__programExerciceDropdown1" id="__programExerciceDropdown1-label" class="accordion-header form-label fw-bold p-0 col-10 col-md-11">
                            <button id="__programExerciceDropdown1-button" class="__programExerciceButton accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#__programExerciceCollapse1" aria-expanded="true" aria-controls="collapseOne">
                                Exercice #1
                            </button>
                        </label>
                        <div id="__programExerciceDeleteHeader1" class="__programExerciceDelete col-2 col-md-1" onclick="deleteExercice(1)">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </div>
                    <div id="__programExerciceCollapse1" class="__programExerciceCollapse accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#__programExerciceList">
                        <div class="accordion-body">
                            <select class="form-select" name="programExerciceDropdown1" id="__programExerciceDropdown1" required="required" onchange="displayExercice(1)"><br>
                                <option selected disabled>Exercice</option>

                                <?php

                                    foreach ($results as $exercice){
                                        echo '<option value="'.$exercice['id'].'">'.$exercice['nameExercice'].'</option>';
                                    }

                                ?>

                            </select>
                            <p>L'exercice n'est pas dans la liste? Créez-le</p>
                            <button class="btn btn-primary">+ Créer un exercice</button>
                        

                            <div class="row my-3">
                                <div class="col-12 col-md-6">
                                    <label for="__programSeries1" id="__programSeries1-label">Série(s) : </label><br>
                                    <input type="number" name="programSeries1" id="__programSeries1" required="required" maxlength="3" min="1" max="999" oninput="displayReps(1)">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="__programReps1" id="__programReps1-label">Répétitions : </label><br>
                                    <input type="number" name="programReps1" id="__programReps1" required="required" min="1" max="999" oninput="displayReps(1)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-start my-4">
                <a href="#" class="btn btn-primary" id="__addExercice">+ Ajouter un exercice</a>
            </div>

            <div class="text-center">
                <button type="submit" form="__programAddForm" class="btn btn-primary">Enregistrer le programme</button>
            </div>
        </form>
    </div>

    <div class="col-11 col-lg-4 d-flex justify-content-center">
        <div class="card bg-dark text-white col-12 col-md-6 col-lg-8 text-center p-0 __programCard __programCardPreview">
            <img src="<?= DOMAIN . 'sources/img/preview.png'?>" id="__programImagePreview" class="card-img __programImage" alt="image preview">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title" id="__programNamePreview"></h5>
                        <table class="table text-light card-text __programContent">
                            <tbody id="__programContentPreview">
                                <tr id="__programExercicePreview1" class="__programExercicePreview">
                                    <td id="__programExerciceNamePreview1"></td>
                                    <td id="__programExerciceRepsPreview1"></td>
                                    <td id="__programExerciceDelete1" class="text-end"><i class="fa-solid fa-trash-can" onclick="deleteExercice(1)"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "../../../footer.php";
?>

<script src="<?= DOMAIN . 'js/formulaire.js'?>" crossorigin="anonymous"></script>