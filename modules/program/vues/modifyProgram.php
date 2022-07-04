<?php
$title = "Fitness Essential - Modifier un programme";
$content = "Modification d'un programme";
$currentPage = 'message';
require '../../../header.php';

$pdo = database();

$req = $pdo->query("SELECT id, nameExercice
                    FROM RkU_EXERCICE
                    ORDER BY nameExercice ASC");

$results = $req->fetchAll();
$pId = htmlspecialchars($_GET['id']);
$db = database();

$valuesReq = $db->query("SELECT C.*, P.*, E.*
                            FROM RkU_CONTAINS C
                            LEFT JOIN RkU_PROGRAM P ON C.programId = P.id
                            LEFT JOIN RkU_EXERCICE E ON C.exerciceId = E.id
                            WHERE C.programId = " . $pId);

$valuesResults = $valuesReq->fetchAll();
$counter = count($valuesResults);
?>

<h1 class="aligned-title">Modification d'un programme d'entraînement</h1>

<div class="row d-flex justify-content-center flex-row">
    <div class="col-10 col-lg-7 d-flex justify-content-center flex-column">
        <div class="row">
            <form id="__programUpdateForm" action="../scripts/updateProgram.php?id=<?= $pId ?>" enctype ="multipart/form-data" method="POST" class="my-3">
                <div class="row my-3">
                    <label for="__programTitle">Nom du rogramme : </label>
                    <input class="form-control" type="text" name="programTitle" id="__programTitle" value="<?= $valuesResults[0]['nameProgram'] ?>" oninput="displayProgramTitle()"><br>
                </div>

                <div class="row my-3">
                    <label for="__programFile">Illustration : </label>
                    <input type="file" name="programFile" id="__programFile" value="<?= $valuesResults['illustration'] ?>">
                </div>

                <div id="__programExerciceList" class="accordion" >

                    <?php
                    for ($i = 1; $i <= $counter; $i++){
                        echo 
                        '<div id="__programExercice' . $i . '" class="__programExercice accordion-item">
                            <div class="row">
                                <label for="__programExerciceDropdown' . $i . '" id="__programExerciceDropdown' . $i . '-label" class="accordion-header form-label fw-bold p-0 col-10 col-md-11">
                                    <button id="__programExerciceDropdown' . $i . '-button" class="__programExerciceButton accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#__programExerciceCollapse' . $i . '" aria-expanded="true" aria-controls="collapseOne">
                                        Exercice #' . $i . '
                                    </button>
                                </label>
                                <div id="__programExerciceDeleteHeader' . $i . '" class="__programExerciceDelete col-2 col-md-1" onclick="deleteExercice(' . $i . ')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
                            </div>
                            <div id="__programExerciceCollapse' . $i . '" class="__programExerciceCollapse accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#__programExerciceList">
                                <div class="accordion-body">
                                    <select class="form-select" name="programExerciceDropdown' . $i . '" id="__programExerciceDropdown' . $i . '" required="required" onchange="displayExercice(' . $i . ')"><br>
                                        <option selected disabled value="0">Exercice</option>'?>
                                        <?php
                                            foreach ($results as $key => $exercice){
                                                if ($exercice['nameExercice'] == $valuesResults[$i-1]['nameExercice']){
                                                    echo '<option selected value="'.$exercice['id'].'">'.$exercice['nameExercice'].'</option>';
                                                } else {
                                                    echo '<option value="'.$exercice['id'].'">'.$exercice['nameExercice'].'</option>';
                                                }
                                            }?> 
                
                                    <?='</select>
                                    <p>L\'exercice n\'est pas dans la liste? Créez-le</p>
                                    <button class="btn btn-primary">+ Créer un exercice</button>
                                

                                    <div class="row my-3">
                                        <div class="col-12 col-md-6">
                                            <label for="__programSeries' . $i . '" id="__programSeries' . $i . '-label">Série(s) : </label><br>
                                            <input type="number" name="programSeries' . $i . '" id="__programSeries' . $i . '" maxlength="3" min="1" max="999" oninput="displayReps(' . $i . ')" value="'. $valuesResults[$i-1]['series']. '">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="__programReps' . $i . '" id="__programReps' . $i . '-label">Répétitions : </label><br>
                                            <input type="number" name="programReps' . $i . '" id="__programReps' . $i . '" min="1" max="999" oninput="displayReps(' . $i . ')" value="'. $valuesResults[$i-1]['repeats']. '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                
                    
                </div>
            </form>
        </div>

        <div class="row">
            <div class="text-start my-4">
                <a href="#" class="btn btn-primary" id="__addExercice">+ Ajouter un exercice</a>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <input type="submit" form="__programUpdateForm" class="btn btn-primary" value="Enregistrer le programme">
            </div>
        </div>
    </div>

    <div class="col-11 col-lg-4 d-flex justify-content-center">
        <div class="card bg-dark text-white col-12 col-md-6 col-lg-8 text-center p-0 __programCard __programCardPreview">
            <img src="<?= DOMAIN . 'sources/img/preview.png'?>" id="__programImagePreview" class="card-img __programImage" alt="image preview">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title" id="__programNamePreview"><?= $valuesResults[0]['nameProgram'] ?></h5>
                        <table class="table text-light card-text __programContent">
                            <tbody id="__programContentPreview">
                            <?php
                            for ($i = 1; $i <= $counter; $i++){
                                echo 
                                '<tr id="__programExercicePreview' . $i . '" class="__programExercicePreview">
                                    <td id="__programExerciceNamePreview' . $i . '">' . $valuesResults[$i-1]['nameExercice'] . '</td>
                                    <td id="__programExerciceRepsPreview' . $i . '">' . $valuesResults[$i-1]['series'] . 'x' . $valuesResults[$i-1]['repeats'] . '</td>
                                    <td id="__programExerciceDelete' . $i . '" class="text-end"><i class="fa-solid fa-trash-can" onclick="deleteExercice(' . $i . ')"></i></td>
                                </tr>';
                            }
                            ?>
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