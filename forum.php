<?php
    $title = "Fitness Essential - Forum";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
    Message('No Topic');
    Message('createCategorie');

    if(!isConnected()){
        echo "Pour accéder au forum, merci de vous inscrire";
        die();
    }
    
    $pdo = database();

    $req = $pdo->query("SELECT * FROM RkU_TOPIC ORDER BY topicOrder");

    $results = $req->fetchAll();
?>

<h2 class="aligned-title"> Les réponses à vos questions </h2>

<div class="container-fluid">
    <div class="col d-flex justify-content-center">
        <?php if(isAdmin()){ ?>
            <a class="btn btn-primary" href="newCategorie.php" role="button">Nouvelle catégorie</a>
        <?php }?>
    </div>
</div>

        <div class="container">
            <div class="row">

<?php
    foreach($results as $categorie){
?>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card __topic">
                        <img src="sources/img/<?php echo $categorie['path'] ?>" class="card-img-top __topicImg" alt="...">
                        <div class="card-body">
                            <h5 class="card-title __topicTitle"><?php echo $categorie['title'] ?></h5>
                            <p class="card-text __topicDescription"><?php echo $categorie['description'] ?></p>
                            <a href="categorie.php?idTopic=<?= $categorie['id'] ?>" class="btn btn-primary">Explorer</a>
                            <?php
                                if(isAdmin()){
                            ?>
                                <a href="manageCategorie.php?idTopic=<?= $categorie['id'] ?>" class="btn btn-primary">Modifier</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>        
                
                
                
                
<?php
} 
?>

            </div>
        </div>

<!-- <div class="row">
    <form action="uploadImage.php" method = "POST" enctype ="multipart/form-data"> // Le enctype permet de spécifier que les données envoyées lors de l'envoie sont encodées lors de la soumission au serveur.
        <div class="col-4 mb-2">
            <label for="file" class="form-label">Veuillez insérer votre image</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <div class="col-4">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div> -->


<?php
    include 'footer.php';
?>