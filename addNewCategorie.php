<?php

require 'functions.php';

$pdo = database();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createCategorie'])){
        $categorie = $_POST['categorieName'];
        $description = $_POST['categorieDescription'];
        $order = $_POST['categorieOrder'];
        $image = $_POST['categorieImage'];
        
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
            
        if(empty($image)){
            $valid = false;
            $errors = "Il faut ajouter une image à la catégorie";
        }
    }

    //insertion base de données si valide à faire
    if ($valid) {

        $insertQuestionQuery = $pdo->prepare("INSERT INTO RkU_TOPIC (title, description, topicOrder, path)
                VALUES 
                (:title, :description, :topicOrder, :path)");

        $insertQuestionQuery->execute([
            'title'=>$categorie,
            'description'=>$description,
            'topicOrder'=>$order,
            'path'=>$image
        ]);

        setMessage('createQuestion', ['Votre nouvelle catégorie a bien été créée'], 'success');
        header('Location: forum.php');
        exit;
    }
    else{
        setMessage('createQuestion', [$errors], 'warning');
        header('Location: forum.php');
        exit;
    }
        

}

?>