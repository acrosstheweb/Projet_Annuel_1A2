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
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">PULL #2</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>5X5</td>
                                </tr>
                                <tr>
                                    <td>Tirage horizontal</td>
                                    <td>4X8</td>
                                </tr>
                                <tr>
                                    <td>Face pull</td>
                                    <td>4X15</td>
                                </tr>
                                <tr>
                                    <td>Lat pulldown</td>
                                    <td>3X15</td>
                                </tr>
                                <tr>
                                    <td>Tirage vertical serré</td>
                                    <td>4X8</td>
                                </tr>
                                <tr>
                                    <td>Curl poulie</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Curl poulie corde</td>
                                    <td>4X12</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMorePull2" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessPull2" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>