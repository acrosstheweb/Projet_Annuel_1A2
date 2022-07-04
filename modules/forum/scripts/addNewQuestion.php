<?php

require '../../../functions.php';

$pdo = database();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createQuestion'])){
        $question = htmlspecialchars(trim($_POST['question']));
        $content = htmlspecialchars(trim($_POST['content']));
        $idTopic = htmlspecialchars(trim($_GET['idTopic']));
        
        if(empty($question)){
            $valid = false;
            $errors = ("Il faut mettre un titre");
        }

        if(empty($content)){
            $valid = false;
            $errors = ("Il faut mettre un contenu");
        }
            
        if(empty($idTopic)){
            $valid = false;
            $errors = "La catégorie ne peut pas être vide";
        }
        
        else{

            $checkTopic = $pdo->query("SELECT id, title FROM RkU_TOPIC WHERE id = $idTopic");

            $results = $checkTopic->fetch();

            if (!isset($results['id'])){
                $valid = false;
                $errors = "Cette catégorie n'existe pas";
            }
        }
    }

    //insertion base de données si valide à faire
    if ($valid) {

        $insertQuestionQuery = $pdo->prepare("INSERT INTO RkU_QUESTION (title, content, userId, topic, status)
                VALUES 
                (:title, :content, :userId, :topic, :status)");

        $insertQuestionQuery->execute([
            'title'=>$question,
            'content'=>$content,
            'userId'=>$_SESSION['userId'],
            'topic'=>$idTopic,
            'status'=>1
        ]);

        setMessage('createQuestion', ['Votre question a bien été enregistrée'], 'success');
    }
    else{
        setMessage('createQuestion', [$errors], 'warning');
    }
    header('Location: ../vues/categorie.php?idTopic='.$idTopic);
    exit;

}
