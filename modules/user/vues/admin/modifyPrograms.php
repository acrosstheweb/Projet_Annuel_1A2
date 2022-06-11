<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message('Delete');
Message('Modify');
Message('CreateUser');


$pdo = database();

$req = $pdo->query("SELECT C.*, P.*, E.*
                    FROM RkU_CONTAINS C
                    LEFT JOIN RkU_PROGRAM P ON C.programId = P.id
                    LEFT JOIN RkU_EXERCICE E ON C.exerciceId = E.id
                        ");

$results = $req->fetchAll();

?>

<h1 class="aligned-title">Modification des programmes</h1>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="d-none col-3 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-8">
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
                            <th>Nom du programme</th>
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
                    $lastProgramId = $program['programId'];
                } elseif (($program['programId'] != $lastProgramId)) {
                ?>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <a href="#" class="btn btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo '<img src="' . DOMAIN . $program['illustration'] .'" class="img-fluid __programIcon" alt="program illustration">'?></td>
                            <td class="align-middle"><?php echo $program['nameProgram'];?></td>
                            <td class="d-none d-lg-table-cell">
                                <ul>
            <?php
                $lastProgramId = $program['programId'];
                }
            echo '<li>' . $program['nameExercice'] . '</li>';
            }
            ?>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <a href="#" class="btn btn-outline-primary m-1" data-bs-toggle="modal" data-bs-target="#"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
include "../../../../footer.php";
?>