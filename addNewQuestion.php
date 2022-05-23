<?php

require 'functions.php';

$pdo = database();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];
    echo "Ca fonctionne";

    if(isset($_POST['createQuestion'])){
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
            $errors = "La catégorie ne peut pas être vide";
        }
        
        else{

            $checkTopic = $pdo->query("SELECT id, title FROM RkU_TOPIC WHERE id = $topic");

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
            'topic'=>$topic,
            'status'=>1
        ]);

        setMessage('createQuestion', ['Votre question a bien été enregistrée'], 'success');
        header('Location: categorie.php?id='.$topic);
        exit;
    }
    else{
        setMessage('createQuestion', [$errors], 'warning');
        header('Location: categorie.php?id='.$topic);
        exit;
    }
        

}

?>