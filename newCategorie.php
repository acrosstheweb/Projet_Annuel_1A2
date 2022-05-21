<?php
    $title = "Fitness Essential - Créer Catégorie";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');

    $pdo = database();
    
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
        $errors = [];

        if(isset($_POST['createCategorie'])){
            $question = $_POST['question'];
            $content = $_POST['content'];
			$topic = $_POST['topic'];
			
        if(empty($question)){
            $valid = false;
            $errors = ("Il faut mettre un titre");
        }
 
        if(empty($content)){
            $valid = false;
            $errors = ("Il faut mettre un contenu");
        }
			
        if(empty($topic)){
            $valid = false;
            $errors = "Le mail ne peut pas être vide";
        }
        
        else{

            $checkTopic = $pdo->query("SELECT id, title FROM RkU_TOPIC WHERE id = $topic");
 
            $checkTopic = $verif_cat->fetch();
 
            if (!isset($verif_cat['id'])){
                $valid = false;
                $errors = "Cette catégorie n'existe pas";
        }
    }
 
    //insertion base de données si valide à faire
        if ($valid) {
            $dateCreation = date('Y-m-d H:i:s');

            $insertQuestionQuery = $pdo->prepare("INSERT INTO RkU_QUESTION (creationDate, title, content, userId, topic, status)
                    VALUES 
                    (:creationDate, :title, :content, :userId, :topic, :status)");

            $insertQuestionQuery->execute([
                'creationDate'=>$dateCreation,
                'title'=>$question,
                'content'=>$content,
                'userId'=>$_SESSION['id'],
                'topic'=>$topic,
                'status'=>1,
            ]);
            header('Location: /forum.php/' . $categorie);
            exit;
        }
    }
}

    $req = $pdo->query("SELECT id, title FROM RkU_TOPIC");
    $results = $req->fetchAll();
?>


<h2 class="aligned-title"> Une question</h2>

    <p class="text-center">Votre demande sera traitée dans les plus brefs délais.</p>

    <div class="row d-flex justify-content-center">
        <form action="newCategorie.php" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="messageForum">Sélectionnez un sujet : </label>
                <select class="form-select" name="topic" id="topic"><br>
                    <?php 
                        foreach($results as $result){
                    ?>
                        <option value="<?php $result['id'] ?>"> <?php echo $result['title'] ?> </option>
                    <?php
                        }
                    ?>

                </select>
            </div>

            <div class="row my-3">
                <label for="messageSubject">Question : </label>
                <input class="form-control" type="text" name="question" id="question" placeholder="Posez votre question ici"><br>
            </div>

            <div class="row my-3">
                <label for="messageDescription">Décrivez-nous votre problème : </label>
                <textarea class="form-control" name="content" id="questionContent" placeholder="Ajoutez des éléments de précision à votre question" rows="5"></textarea>
            </div>

            <!-- <div class="row my-3">
                <label for="file" class="form-label">Veuillez insérer votre image</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div> -->

            <div class="text-center mt-4">
                <button type="submit" name="createCategorie" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>