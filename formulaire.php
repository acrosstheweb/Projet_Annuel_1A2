<?php
$title = "Fitness Essential - Créer un programme";
$content = "Création d'un programme";
$currentPage = 'message';
require 'header.php';
?>

<h1 class="aligned-title">Création d'un programme d'entraînement</h1>

<div class="row d-flex justify-content-center">
    <div class="col-10 col-lg-8 d-flex justify-content-center">
        <form id="__programAddForm" action="" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="__programTitle">Programme : </label>
                <input class="form-control" type="text" name="programTitle" id="__programTitle" placeholder="Pull #2"><br>
            </div>

            <div class="row my-3">
                <label for="__programFile">Illustration : </label>
                <input type="file" name="programFile" id="__programFile">
            </div>

            <div class="row my-3">
                <label for="__programExerciceDropdown" class="form-label">Exercice #1</label>
                <select class="form-select" name="programExerciceDropdown" id="__programExerciceDropdown"><br>
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
                    <label for="__programSeries">Série(s) : </label>
                    <input type="number" name="programSeries" id="__programSeries">
                </div>
                <div class="col-12 col-md-6">
                    <label for="__programReps">Répétitions : </label>
                    <input type="number" name="programReps" id="__programReps">
                </div>
            </div>

            <div class="text-left mt-4">
                <button class="btn btn-primary" id="__addExercice">+ Ajouter un exercice</button>
            </div> <br> <br> <br>

            <div class="text-center">
                <button type="submit" form="__programAddForm" class="btn btn-primary">Enregistrer le programme</button>
            </div>
        </form>
    </div>

    <div class="col-11 col-lg-3 d-flex justify-content-center">
        <div class="card bg-dark text-white col-12 col-md-6 col-lg-12 text-center p-0 __programCard">
            <img src="sources/img/pull2.jpg" class="card-img __programImage" alt="pull2">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title"  id="__programNamePreview"></h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr id="__programExercicePreview1">
                                    <td id="__programExerciceNamePreview1"></td>
                                    <td id="__programExerciceRepsPreview1"></td>
                                    <td id="__programExerciceDelete1"></td>
                                </tr>
                                <tr id="__programExercicePreview2">
                                    <td id="__programExerciceNamePreview2"></td>
                                    <td id="__programExerciceRepsPreview2"></td>
                                    <td id="__programExerciceDelete2"></td>
                                </tr>
                                <tr id="__programExercicePreview3">
                                    <td id="__programExerciceNamePreview3"></td>
                                    <td id="__programExerciceRepsPreview3"></td>
                                    <td id="__programExerciceDelete3"></td>
                                </tr>
                                <tr id="__programExercicePreview4">
                                    <td id="__programExerciceNamePreview4"></td>
                                    <td id="__programExerciceRepsPreview4"></td>
                                    <td id="__programExerciceDelete4"></td>
                                </tr>
                                <tr id="__programExercicePreview5">
                                    <td id="__programExerciceNamePreview5"></td>
                                    <td id="__programExerciceRepsPreview5"></td>
                                    <td id="__programExerciceDelete5"></td>
                                </tr>
                                <tr id="__programExercicePreview6">
                                    <td id="__programExerciceNamePreview6"></td>
                                    <td id="__programExerciceRepsPreview6"></td>
                                    <td id="__programExerciceDelete6"></td>
                                </tr>
                                <tr id="__programExercicePreview7">
                                    <td id="__programExerciceNamePreview7"></td>
                                    <td id="__programExerciceRepsPreview7"></td>
                                    <td id="__programExerciceDelete7"></td>
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