<?php
    $title = "Fitness Essential - Catégorie";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require '../../../header.php';
    Message('UploadImage');
    Message('createQuestion');
    Message('manageQuestion');
    
    $idTopic = $_GET['idTopic'];
    
    $pdo = database();

    $req = $pdo->query("SELECT q.*, DATE_FORMAT(q.creationDate, ' le %d/%m/%Y à %Hh%i') as creationDate, U.firstname, U.lastname
                            FROM RkU_QUESTION Q
                            LEFT JOIN RkU_USER U ON Q.userID = U.id
                            WHERE q.topic = $idTopic
                            ORDER BY q.creationDate DESC",
                            );

    $results = $req->fetchAll();

    $req_title_topic = $pdo->query("SELECT title FROM RkU_TOPIC WHERE id=$idTopic");

    $titleTopic = $req_title_topic->fetch()['title'];
?>


<div class="container-fluid">
    <div class="row __categoryControls pt-3 px-3 px-md-5">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/forum/vues/forum.php'?>" role="button">Revenir à la page précedente</a>
        </div>

        <div class="col d-flex justify-content-end">
            <?php if(isConnected()){ ?>
                <a class="btn btn-primary" href="<?= DOMAIN . 'modules/forum/vues/newQuestion.php?idTopic=' . $idTopic ?>" role="button">Poser votre question</a>
            <?php }?>
        </div>
    </div>
</div>


<h1 class="center aligned-title"> Bienvenue sur le forum <?= $titleTopic ?> </h1>


<div class="container">
    <div class="row justify-content-center">

        <?php
            foreach($results as $question){
        ?>
                <div class="col-12">
                    <div class="card <?php echo ($question['status'] == 0) ? "__categoryCardClosed" : ""; ?> m-2">
                        <div class="card-body">

                            <?php if($question['status'] == 0) { ?>
                                <span class="badge rounded-pill float-end __questionStatusBg">Résolu</span>
                            <?php } ?>
                            
                            <h5 class="card-title"><?= $question['title'] ?></h5>
                            
                            <!-- <?php     
                                if($question['status'] == 1)
                                    echo "open"; 
                                elseif ($question['status'] == 0) 
                                    echo"closed";
                            ?> -->
                            <p class="card-text text-muted"><small>Publiée par <?= $question['firstname']?> <?= $question['lastname']?> le <?= $question['creationDate'] ?></small></p>
                            <p class="card-text"><?= $question['content'] ?><br></p>
                            <a href="<?= DOMAIN . 'modules/forum/vues/question.php?idTopic=' . $idTopic . '&idQuestion=' . $question['id'] . '&status=' . $question['status'] ?>" class="btn btn-primary m-1">Voir plus</a>

                            <?php
                            if (isConnected()) {
                                if($question['userId']==$_SESSION['userId']){
                            ?>
                            <div class="btn-group float-end">
                                <a href="#" class="btn btn-primary modifyModal--trigger m-1" data-bs-toggle="modal" data-bs-target="#modifyModalStatus<?= $question['id'];?>">
                                    <?php 
                                        if($question['status'] == 1)
                                            echo "Marquer comme résolu "; 
                                        elseif ($question['status'] == 0) 
                                            echo "Réouvrir ";
                                    ?>
                                </a>
                            </div>

                        <div class="modal fade" id="modifyModalStatus<?= $question['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Fermeture de la question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <form id="closeQuestion<?= $question['id'];?>" action="../scripts/manageQuestion.php?idTopic=<?= $idTopic ?>&idQuestion=<?= $question['id'];?>&status=<?= $question['status'] ?>" method="POST" >
                                                <div class="deleteFormInfo">
                                                    <h5>
                                                        <?php 
                                                            if($question['status'] == 1)
                                                                echo "Vous êtes sur le point de clôturer votre question"; 
                                                            elseif ($question['status'] == 0) 
                                                                echo "Voulez-vous réouvrir votre question ?";
                                                        ?>
                                                    </h5>
                                                    <p class="delete-passwordConfirmDescription">
                                                        <?php 
                                                            if($question['status'] == 1)
                                                                echo "Êtes vous certain de vouloir la fermer ?"; 
                                                            elseif ($question['status'] == 0) 
                                                                echo "Êtes vous certain de vouloir la réouvrir ?";
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="row delete-userPassword">
                                                    <div class="col">
                                                        <label for="delete-userPasswordInput" class="fw-bold">Votre mot de passe</label>
                                                        <input id="delete-userPasswordInput" class="form-control" type="password" name="delete-userPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button class="btn btn-primary modify-passwordConfirm" form="closeQuestion<?= $question['id'];?>" type="submit">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <?php } }?>
                        </div>
                    </div>
                </div>
                
                <?php
                } 
                ?>

            </div>
        </div>

<?php
    include "../../../footer.php";
?>
