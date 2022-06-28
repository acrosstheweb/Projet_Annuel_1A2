<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }
    $title = "Fitness Essential - Liste des programmes";
    $content = "Liste des programmes";
    $currentPage = 'adminPrograms';

require '../../../../header.php';
Message('delProgram');


$pdo = database();

$req = $pdo->query("SELECT C.*, P.*, E.*
                    FROM RkU_CONTAINS C
                    LEFT JOIN RkU_PROGRAM P ON C.programId = P.id
                    LEFT JOIN RkU_EXERCICE E ON C.exerciceId = E.id
                    ORDER BY P.creationDate DESC
                        ");

$results = $req->fetchAll();

?>

<div class="container-fluid d-lg-none">
    <div class="row __profileDropdown">
        <div class="dropdown d-grid gap-2">
            <button class="btn dropdown-toggle text-light" type="button" id="__profileDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $content ?>
            </button>
            <ul class="dropdown-menu justify-content-center __profileDropdownMenu text-light" aria-labelledby="dropdownMenuButton1">
                <?php include 'adminNavbar.php'; ?>
            </ul>
        </div>
    </div>
</div>

<h1 class="aligned-title">Modification des programmes</h1>
<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/program/vues/formulaire.php'?>" class="btn btn-primary">Créer un programme</a>
            </div>
            <div class="table-responsive">
            <?php
            $lastProgramId = "";
            foreach($results as $program){
                if ($program == $results[0]){
            ?>
                
                <table class="table" id="programsTable">
                    <thead>
                        <tr>
                            <th>Illustration</th>
                            <th onclick="sortColumn(0, 'programsTable')">Nom du programme</th>
                            <th class="d-none d-lg-table-cell">Contenu du programme</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo '<img src="' . DOMAIN . $program['illustration'] .'" class="img-fluid __programIcon" alt="program illustration">'?></td>
                            <td class="align-middle"><?php echo $program['nameProgram'];?></td>
                            <td class="d-none d-lg-table-cell">
                                <ul>

                <?php
                } elseif (($program['programId'] != $lastProgramId)) {
                ?>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/program/vues/modifyProgram.php?id=' . $lastProgramId ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#delProgramModal<?=$lastProgramId?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>
                        
                        <div class="modal" id="delProgramModal<?=$lastProgramId?>" aria-hidden="true" aria-labelledby="delProgramModal-label" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delProgramModal-label">Suppression du programme <?=$lastProgramId?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <h6>Voulez-vous vraiment supprimer le programme <?= $program['nameProgram'] ?> ?</h6>
                                        <div class="col-3"></div>
                                        <form id="delProgram-form<?=$lastProgramId?>" action=<?= DOMAIN . "modules/program/scripts/delProgram.php?pId=$lastProgramId"?> method="POST" class="col-6">
                                            <label for="delProgram-password<?=$lastProgramId?>">Mot de passe : </label>
                                            <input class="form-control" type="password" name="delProgram-password" id="delProgram-password<?=$lastProgramId?>" placeholder="Mot de passe" required="required">
                                        </form>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                        <button class="btn btn-primary" type='submit' form="delProgram-form<?=$lastProgramId?>">Supprimer le programme</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td><?php echo '<img src="' . DOMAIN . $program['illustration'] .'" class="img-fluid __programIcon" alt="program illustration">'?></td>
                            <td class="align-middle"><?php echo $program['nameProgram'];?></td>
                            <td class="d-none d-lg-table-cell">
                                <ul>
            <?php
                }
                echo '<li>' . $program['nameExercice'] . '</li>';

                if ($program == end($results)){
                ?>
                    </ul>
                            </td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/program/vues/modifyProgram.php?id=' . $program['programId'] ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#delProgramModal<?=$program['programId']?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>

                        <div class="modal" id="delProgramModal<?=$program['programId']?>" aria-hidden="true" aria-labelledby="delProgramModal-label" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delProgramModal-label">Suppression du programme <?=$program['programId']?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <h6>Voulez-vous vraiment supprimer le programme <?= $program['nameProgram'] ?> ?</h6>
                                        <div class="col-3"></div>
                                        <form id="delProgram-form<?=$program['programId']?>" action=<?= DOMAIN . "modules/program/scripts/delProgram.php?pId=" . $program['programId'] ?> method="POST" class="col-6">
                                            <label for="delProgram-password<?=$program['programId']?>">Mot de passe : </label>
                                            <input class="form-control" type="password" name="delProgram-password" id="delProgram-password<?=$program['programId']?>" placeholder="Mot de passe" required="required">
                                        </form>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                        <button class="btn btn-primary" type='submit' form="delProgram-form<?=$program['programId']?>">Supprimer le programme</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
                    
                <?php
                }
            
                $lastProgramId = $program['programId'];
            }
            ?>
                                
            </div>
        </div>

    </div>
</div>



<?php
include "../../../../footer.php";
?>

<script src="<?= DOMAIN . 'js/admin-users.js'?>" crossorigin="anonymous"></script>