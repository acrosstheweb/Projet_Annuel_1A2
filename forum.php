<?php
    $title = "Fitness Essential - Forum";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
    Message('No Topic');
    Message('createCategorie');
    Message('Modify');
    Message('Delete');

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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modifyCategorie<?= $categorie['id'];?>" class="btn btn-primary">Modifier</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCategorie<?= $categorie['id'];?>" class="btn btn-primary">Supprimer</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="modal fade" id="modifyCategorie<?= $categorie['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modification de la catégorie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="manageCategorie<?= $categorie['id'];?>" action="manageCategorie.php?idTopic=<?= $categorie['id'] ?>" enctype ="multipart/form-data" method="POST" >
                                        <div class="row deleteFormInfo">
                                            <h5>Vous modifiez la catégorie <?= $categorie['title'];?> </h5>

                                            <div class="col-12">
                                                <label for="modify-title<?php echo $categorie['title'];?>" class="fw-bold">Titre</label>
                                                <input id="modify-title<?php echo $categorie['title'];?>" class="form-control" type="text" name="modify-title" value="<?php echo $categorie['title'];?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="modify-description<?php echo $categorie['description'];?>" class="fw-bold">Description</label>
                                                <input id="modify-description<?php echo $categorie['description'];?>" class="form-control" type="text" name="modify-description" value="<?php echo $categorie['description'];?>">
                                            </div>
                                            <div class="col-12">
                                                <label for="modify-order<?php echo $categorie['topicOrder'];?>" class="fw-bold">Ordre</label>
                                                <input id="modify-order<?php echo $categorie['topicOrder'];?>" class="form-control" type="number" name="modify-order" value="<?php echo $categorie['topicOrder'];?>">
                                            </div>

                                        </div>
                                        <div class="row modify-userPassword">
                                            <div class="col-12">
                                                <label for="modify-adminPasswordInput" class="fw-bold">Votre mot de passe</label>
                                                <input id="modify-adminPasswordInput" class="form-control" type="password" name="modify-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button class="btn btn-primary modify-passwordConfirm" form="manageCategorie<?= $categorie['id'];?>" type="submit">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteCategorie<?= $categorie['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Suppression catégorie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="deleteCategorie<?= $categorie['id'];?>" action="delCategorie.php?idTopic=<?= $categorie['id'];?>" method="POST" >
                                        <div class="deleteFormInfo">
                                            <h5>Vous êtes sur le point de supprimer cette catégorie</h5>
                                            <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir la supprimer?</p>
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
                                    <button class="btn btn-primary delete-passwordConfirm" form="deleteCategorie<?= $categorie['id'];?>" type="submit">Supprimer</button>
                                </div>
                            </div>
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