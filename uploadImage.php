<?php
    $title = "Fitness Essential - Forum";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    include 'header.php';
?>

<div class="row">
    <form action="forum.php" method = "POST" enctype ="multipart/form-data"> // Le enctype permet de spécifier que les données envoyées lors de l'envoie sont encodées lors de la soumission au serveur.
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
    if(isset($_FILES['file'])){
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];
        $problems = [];
        
        $splitNameExtension = explode('.', $name); // On split le nom du fichier "image.png" en 2 avec le point comme séparateur
        $nameExtension = strtolower(end($splitNameExtension)); // On met en minuscule le dernier élément du tableau $splitNameExtension

        $extensionAllowed = ['png', 'jpeg', 'jpg', 'gif'];
        $maxSize = 400000;

        if(in_array($nameExtension, $extensionAllowed) && $size <= $maxSize && $error == 0){

            $uniqueName = uniqid('', true);
            $fileName = $uniqueName.''.$nameExtension;

            move_uploaded_file($tmp_name, './uploadFiles/'.$fileName);   
        }

    }
    else{
        die();
    }
?>