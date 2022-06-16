<?php

require '../../../functions.php';

$pdo = database();

// var_dump($_FILES); echo "<br>";
// var_dump($_POST); 
// die();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createCategorie'])){
        $categorie = trim($_POST['categorieName']);
        $description = trim($_POST['categorieDescription']);
        $order = trim($_POST['categorieOrder']);
        $tempNameImage = trim($_FILES['categorieImage']['tmp_name']);
        $nameImage = trim($_FILES['categorieImage']['name']);
        $typeImage = $_FILES['categorieImage']['type'];
        $type = ['image/png', 'image/jpg', 'image/jpeg'];

        
        if(empty($categorie)){
            $valid = false;
            $errors = ("Il faut donner un nom à la catégorie");
        }

        if(empty($description)){
            $valid = false;
            $errors = ("Il faut ajouter une description à la catégorie");
        }
        
        if(empty($order)){
            $valid = false;
            $errors = ("Il faut ajouter un ordre");
        }
            
        if(empty($nameImage)){
            $valid = false;
            $errors = "Il faut ajouter une image à la catégorie";
        }

        if(!in_array($typeImage, $type)){
            $valid = false;
            $errors = "Le fichier n'est pas bon";
        }

    }

    //insertion base de données si valide à faire
    if ($valid) {

        move_uploaded_file($tempNameImage, ABSOLUTE_PATH . 'sources/img/' . $nameImage);

        $insertQuestionQuery = $pdo->prepare("INSERT INTO RkU_TOPIC (title, description, topicOrder, path)
                VALUES 
                (:title, :description, :topicOrder, :path)");

        $insertQuestionQuery->execute([
            'title'=>$categorie,
            'description'=>$description,
            'topicOrder'=>$order,
            'path'=>$nameImage
        ]);

        setMessage('createCategorie', ['Votre nouvelle catégorie a bien été créée'], 'success');
        header('Location: ../vues/forum.php');
        exit;
    }
    else{
        setMessage('createCategorie', [$errors], 'warning');
        header('Location: ../vues/forum.php');
        exit;
    }
        

}

?>