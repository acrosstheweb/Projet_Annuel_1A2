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
                    ORDER BY P.creationDate DESC
                        ");

$results = $req->fetchAll();

?>

<h1 class="aligned-title">Modification des programmes</h1>
<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
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
                } elseif (($program['programId'] != $lastProgramId)) {
                ?>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <a href="<?= DOMAIN . 'modules/program/vues/modifyProgram.php?id=' . $lastProgramId ?>" class="btn btn-outline-primary m-1"><i class="fa-solid fa-pen"></i><span class="d-none d-lg-inline"> Modifier</span></a>
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#delProgramModal<?= $lastProgramId ?>"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>
                        
                        <div class="modal" id="delProgramModal<?= $lastProgramId ?>" aria-hidden="true" aria-labelledby="delProgramModal-label" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delProgramModal-label">Suppression du programme <?= $lastProgramId ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-3"></div>
                                        <form id="login-form" action=<?= DOMAIN . "modules/user/scripts/login.php"?> method="POST" class="col-6">
                                            <label for="login-email">Adresse mail : </label>
                                            <input class="form-control" type="email" name="login-email" id="login-email" placeholder="Adresse mail" required="required"><br>

                                            <label for="login-password">Mot de passe : </label>
                                            <input class="form-control" type="password" name="login-password" id="login-password" placeholder="Mot de passe" required="required">
                                            
                                            <label for="login-remember">Se souvenir de moi</label>
                                            <input type="checkbox" name="login-remember" id="login-remember">

                                            <small class="form-text text-muted"><a href=<?=DOMAIN . "modules/user/vues/passwordForgotten.php" ?> style="float:right;">Mot de passe oublié ?</a></small>
                                        </form>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                        <button class="btn btn-secondary" data-bs-target="#register-modal" data-bs-toggle="modal">Inscription</button>
                                        <button class="btn btn-primary" form="login-form">Connexion</button>
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
                                <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#delProgramModal"><i class="fa-solid fa-trash-can"></i><span class="d-none d-lg-inline"> Supprimer</span></a>
                            </td>
                        </tr>
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