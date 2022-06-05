<?php
$title = "Fitness Essential - Créer un programme";
$content = "Création d'un programme";
$currentPage = 'message';
require 'header.php';
?>

<h1 class="aligned-title">Création d'un programme d'entraînement</h1>

<div class="row d-flex justify-content-center">
    <div class="col-10 col-lg-7 d-flex justify-content-center">
        <form id="__programAddForm" action="" method="POST" class="col-10 my-3">
            <div class="row my-3">
                <label for="__programTitle">Programme : </label>
                <input class="form-control" type="text" name="programTitle" id="__programTitle" placeholder="Pull #2" oninput="displayProgramTitle()"><br>
            </div>

            <div class="row my-3">
                <label for="__programFile">Illustration : </label>
                <input type="file" name="programFile" id="__programFile" required="required">
            </div>

            <div id="__programExerciceList">
                <div id="__programExercice1" class="__programExercice my-5 border-top">
                    <div class="row my-3">
                        <label for="__programExerciceDropdown1" class="form-label fw-bold">Exercice #1</label>
                        <select class="form-select" name="programExerciceDropdown" id="__programExerciceDropdown1" required="required" onchange="displayExercice(1)"><br>
                            <option selected disabled>Exercice</option>
                            <option value="1">Biceps Curl</option>
                            <option value="2">Developpé couché</option>
                            <option value="3">Rowing barre</option>
                            <option value="4">Squat</option>
                        </select>
                        <p>L'exercice n'est pas dans la liste? Créez-le</p>
                        <button class="btn btn-primary">+ Créer un exercice</button>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-md-6">
                            <label for="__programSeries1">Série(s) : </label><br>
                            <input type="number" name="programSeries" id="__programSeries1" oninput="displayReps(1)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="__programReps1">Répétitions : </label><br>
                            <input type="number" name="programReps" id="__programReps1" oninput="displayReps(1)">
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-left my-4">
                <a href="<?= DOMAIN . '#'?>" class="btn btn-primary" id="__addExercice">+ Ajouter un exercice</a>
            </div>

            <div class="text-center">
                <button type="submit" form="__programAddForm" class="btn btn-primary">Enregistrer le programme</button>
            </div>
        </form>
    </div>

    <div class="col-11 col-lg-4 d-flex justify-content-center">
        <div class="card bg-dark text-white col-12 col-md-6 col-lg-8 text-center p-0 __programCard __programCardPreview">
            <img src="<?= DOMAIN . 'sources/img/pull2.jpg'?>" class="card-img __programImage" alt="pull2">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title" id="__programNamePreview"></h5>
                        <table class="table text-light card-text __programContent">
                            <tbody id="__programContentPreview">
                                <tr id="__programExercicePreview1">
                                    <td id="__programExerciceNamePreview1"></td>
                                    <td id="__programExerciceRepsPreview1"></td>
                                    <td id="__programExerciceDelete1"><i class="fa-solid fa-trash-can"></i></td>
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
    include "footer.php";
?>

<script src="<?= DOMAIN . 'js/formulaire.js'?>" crossorigin="anonymous"></script>