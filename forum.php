<?php
    $title = "Fitness Essential - Forum";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
?>

<h2 class="aligned-title"> Forum de Fitness Essential </h2>

<div class="row">
    <form action="uploadImage.php" method = "POST" enctype ="multipart/form-data"> // Le enctype permet de spécifier que les données envoyées lors de l'envoie sont encodées lors de la soumission au serveur.
        <div class="col-4 mb-2">
            <label for="file" class="form-label">Veuillez insérer votre image</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <div class="col-4">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>


<?php
    include 'footer.php';
?>