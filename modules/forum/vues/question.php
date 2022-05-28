<?php
    $title = "Fitness Essential - Question";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';

    require_once 'functions.php';

    $idTopic = $_GET['idTopic'];
    $idQuestion = $_GET['idQuestion'];
    $status = $_GET['status'];
    
    if(empty($idTopic) || empty($idQuestion)){
        header('Location: forum.php');
        die();
    }
    
    require '../../../header.php';
    Message('UploadImage');
    Message('createComment');
    

    $pdo = database();

    $req = $pdo->query("SELECT q.*, DATE_FORMAT(q.creationDate, ' le %d/%m/%Y à %Hh%i') as creationDate, U.firstname
                            FROM RkU_QUESTION Q
                            LEFT JOIN RkU_USER U ON Q.userID = U.id
                            WHERE q.topic = $idTopic AND q.id = $idQuestion
                            ORDER BY q.creationDate DESC"
                        );

    $results = $req->fetch();

    require_once 'functions.php';
    if(!isset($results['id'])){
        header('Location: forum.php/' . $idTopic);
        die();
      }  

    
    $reqComments = $pdo->query("SELECT m.*, DATE_FORMAT(m.dateSend, ' le %d/%m/%Y à %Hh%i') as dateSend, U.firstname, U.lastname
                FROM RkU_MESSAGE M
                LEFT JOIN RkU_USER U ON M.userId = U.id
                WHERE M.question = $idQuestion
                ORDER BY m.dateSend"
                                        );
    
    $resultsComments = $reqComments->fetchAll();

?>

<div class="container-fluid">
    <div class="row __categoryControls pt-3 px-3 px-md-5">
        <div class="col">
            <a class="btn btn-primary" href="categorie.php?idTopic=<?= $idTopic ?>" role="button">Revenir à la page précedente</a>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        
        
        <div class="col-12">
            <div class="__questionTitle">
                <h1><?= $results["title"] ?> </h1>

                <div class="<?php echo ($results["status"] == 0) ? "__questionClosed" : "" ?>"></div>

                <div class="__questionContent">
                    <?= $results["content"] ?> <br>
                </div>

                <div style="color: #CCC; font-size: 10px; text-align: right">
                    <?= $results["creationDate"] ?> par <?= $results["firstname"] ?>
                </div>

                

                <div class="__questionComments">
                    <h2>Commentaires</h2>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <?php foreach($resultsComments as $comment){ ?>

                                <tr>
                                    <td>
                                        <?= $comment['content'] ?><br>
                                        <div class="text-muted"><small>Écrit par <?= $comment['firstname'] ?> <?= $comment['lastname'] ?>, <?= $comment['dateSend'] ?></small></div>
                                        
                                        <div class="float-end">
                                        <?php
                                            if($comment['userId']==$_SESSION['userId']){
                                        ?>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-danger deleteModal--trigger py-1 px-2" data-bs-toggle="modal" data-bs-target="#delModalComment<?= $comment['id'];?>"><small>Supprimer</small></a>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal fade" id="delModalComment<?= $comment['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression commentaire</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="deleteCommentUser<?= $comment['id'];?>" action="../scripts/delComment.php?id=<?= $comment['id'];?>" method="POST" >
                                                        <div class="deleteFormInfo">
                                                            <h5>Vous êtes sur le point de supprimer votre commentaire</h5>
                                                            <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le supprimer?</p>
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
                                                    <button class="btn btn-primary delete-passwordConfirm" form="deleteCommentUser<?= $comment['id'];?>" type="submit">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>

                                </tr>   
                            <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <?php
                                        if (isConnected() && $status == 1) {
                                    ?>
                                        <h2>Participer à la discussion</h2>

                                        <form method="post" action="../scripts/addComment.php?idTopic=<?= $idTopic ?>&idQuestion=<?= $idQuestion ?>&status=<?= $status ?>">
                                            <div class="form-group">
                                                <textarea class="form-control" name="content" id="content" rows="4" placeholder="Écrivez votre commentaire"></textarea>
                                            </div>
                                            <div class="form-group mt-3">
                                                <button class="btn btn-primary" type="submit" name="addComment">Envoyer</button>
                                            </div>
                                        </form>
                                    
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
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
