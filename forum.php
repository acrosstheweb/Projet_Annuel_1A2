<?php
    $title = "Fitness Essential - Forum";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
    Message('No Topic');
    
    $pdo = database();

    $req = $pdo->query("SELECT * FROM RkU_TOPIC ORDER BY topicOrder");

    $results = $req->fetchAll();
?>

<h2 class="aligned-title"> Forum de Fitness Essential </h2>

        <div class="container">
            <div class="row">

<?php
    foreach($results as $categorie){
?>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="card" style="width: 30rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $categorie['title'] ?></h5>
                            <p class="card-text"><?php echo $categorie['description'] ?></p>
                            <a href="question.php?id=<?php echo $categorie['id'] ?>" class="btn btn-primary">Go somewhere</a>
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