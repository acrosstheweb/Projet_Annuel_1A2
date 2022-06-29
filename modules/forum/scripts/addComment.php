<?php
require '../../../functions.php';

$idTopic = htmlspecialchars($_GET['idTopic']);
$idQuestion = htmlspecialchars($_GET['idQuestion']);
$status = htmlspecialchars($_GET['status']);

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['addComment']))
        $content = htmlspecialchars(trim($_POST['content']));

    if(empty($content)){
        $valid = false;
        $errors = "Il faut rajouter un commentaire";
    }
    elseif(strlen($content) < 3){
        $valid = false;
        $errors = "Il faut que le commentaire fasse plus de 3 caractères";
    }

    if ($valid) {
        $pdo = database();

        $insertCommentQuery = $pdo->prepare("INSERT INTO RkU_MESSAGE (content, userId, question)
                VALUES 
                (:content, :userId, :question)");

        $insertCommentQuery->execute([
            'content'=>$content,
            'userId'=>$_SESSION['userId'],
            'question'=>$idQuestion
        ]);
        
        setMessage('createComment', ['Votre commentaire a bien été ajouté'], 'success');
        header('Location: ../vues/question.php?idTopic='.$idTopic.'&idQuestion='.$idQuestion.'&status='.$status);
        exit;
    }


}