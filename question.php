<?php
    $title = "Fitness Essential - Question";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';

    require_once 'functions.php';

    $idTopic = $_GET['idTopic'];
    $idQestion = $_GET['idQuestion'];
    $_SESSION['idQuestion'] = $idQestion;
    $_SESSION['idTopic'] = $idTopic;
    
    if(empty($idTopic) || empty($idQestion)){
        header('Location: forum.php');
        die();
    }
    
    require 'header.php';
    Message('UploadImage');
    Message('createComment');
    Message('Delete');
    

    $pdo = database();

    $req = $pdo->query("SELECT q.*, DATE_FORMAT(q.creationDate, ' le %d/%m/%Y à %Hh%i') as creationDate, U.firstname
                            FROM RkU_QUESTION Q
                            LEFT JOIN RkU_USER U ON Q.userID = U.id
                            WHERE q.topic = $idTopic AND q.id = $idQestion
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
                WHERE M.question = $idQestion
                ORDER BY m.dateSend DESC"
                                        );
    
    $resultsComments = $reqComments->fetchAll();

?>

<a class="btn btn-primary" href="categorie.php?id=<?php echo $idTopic ?>" role="button">Revenir à la page précedente</a>


<div class="container">
    <div class="row">
        
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="center aligned-title"> <?php echo $results["title"] ?> </h2>

            <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px">
                <h3>Question</h3>

                <div style="border-top: 2px solid #eee; padding: 10px 0">
                    <?php echo $results["content"] ?> <br>
                </div>

                <div style="color: #CCC; font-size: 10px; text-align: right">
                    <?php echo $results["creationDate"] ?> par <?php echo $results["firstname"] ?>
                </div>

                <?php
                    if (isConnected()) {
                ?>

                <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px; margin-top: 20px">
					<h3>Participer à la discussion</h3>

                    <form method="post" action = "addComment.php">
						<div class="form-group">
						    <textarea class="form-control" name="content" id = "content" rows="4"></textarea>
						</div>
                        <div class="form-group">
					        <button class="btn btn-primary" type="submit" name="addComment">Envoyer</button>
                        </div>
                    </form>
                
                </div>
                <?php
                    }
                ?>

                <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px; margin-top: 20px">
                    <h3>Commentaires</h3>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <?php foreach($resultsComments as $comment){ ?>


                                <tr>
                                    <td>De <?php echo $comment['firstname'] ?> <?php echo $comment['lastname'] ?></td>
                                    <td><?php echo $comment['content'] ?></td>
                                    <td><?php echo $comment['dateSend'] ?></td>
                                    <?php
                                        if($comment['userId']==$_SESSION['userId']){
                                    ?>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-danger deleteModal--trigger" data-bs-toggle="modal" data-bs-target="#delModalComment<?php echo $comment['id'];?>">Supprimer</a>
                                        </div>
                                    </td>

                                    <div class="modal fade" id="delModalComment<?php echo $comment['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression commentaire</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="deleteCommentUser<?php echo $comment['id'];?>" action="delComment.php?id=<?php echo $comment['id'];?>" method="POST" >
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
                                                    <button class="btn btn-primary delete-passwordConfirm" form="deleteCommentUser<?php echo $comment['id'];?>" type="submit">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>

                                </tr>   
                            <?php
                            }
                            ?>
                        </table>
                    
                    </div>
                </div>      



            </div>
        </div>
               
        


    </div>
</div>

