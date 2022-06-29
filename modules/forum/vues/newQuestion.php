<?php
    $title = "Fitness Essential - Créer Question";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';

    $idTopic = $_GET['idTopic'];

    require_once '../../../functions.php';

    if(!isConnected()){
        header('Location: error404.php');
        die();
    }

    require '../../../header.php';
    Message('UploadImage');

    $pdo = database();

    $req = $pdo->query("SELECT title FROM RkU_TOPIC");
    $results = $req->fetchAll();

?>
<div class="container-fluid">
    <div class="row __categoryControls pt-3 px-3 px-md-5">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN ?>. 'modules/forum/vues/categorie.php?idTopic=' . <?= $idTopic ?>" role="button">Revenir à la page précedente</a>
        </div>
    </div>
</div>

<h2 class="aligned-title"> Une question</h2>

    <p class="text-center">Votre demande sera traitée dans les plus brefs délais.</p>

    <div class="row d-flex justify-content-center">
        <form action="../scripts/addNewQuestion.php?idTopic=<?php echo $idTopic ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="topic">Sélectionnez un sujet : </label>
                <select class="form-select" name="topic" id="topic"><br>
                    <option default value="0">CHOISIR</option>
                    <?php 
                        foreach($results as $topic){
                    ?>
                        <option value="<?php echo $idTopic ?>"> <?php echo $topic['title'] ?> </option>
                    <?php
                        }
                    ?>

                </select>
            </div>

            <div class="row my-3">
                <label for="question">Question : </label>
                <input class="form-control" type="text" name="question" id="question" placeholder="Posez votre question ici"><br>
            </div>

            <div class="row my-3">
                <label for="messageDescription">Décrivez-nous votre problème : </label>
                <textarea class="form-control" name="content" id="questionContent" placeholder="Ajoutez des éléments de précision à votre question" rows="5"></textarea>
            </div>

                <!-- Il faut rajouter une image dans la base de données -->
            <!-- <div class="row my-3">
                <label for="file" class="form-label">Veuillez insérer votre image</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div> -->

            <div class="text-center mt-4">
                <button type="submit" name="createQuestion" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>