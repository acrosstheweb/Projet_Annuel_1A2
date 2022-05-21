<?php
    $title = "Fitness Essential - Catégorie";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
    
    $idTopic = $_GET['id'];
    

    $pdo = database();

    $req = $pdo->query("SELECT q.*, DATE_FORMAT(q.creationDate, ' le %d/%m/%Y à %Hh%i') as creationDate, U.firstname
                            FROM RkU_QUESTION Q
                            LEFT JOIN RkU_USER U ON Q.userID = U.id
                            WHERE q.topic = $idTopic
                            ORDER BY q.creationDate DESC",
                            );

    $results = $req->fetchAll();
?>

<a class="btn btn-primary" href="forum.php" role="button">Revenir à la page précedente</a>
<a class="btn btn-primary" href="newCategorie.php" role="button">Poser votre question</a>

<h2 class="center aligned-title"> Les différentes questions du topic</h2>

        <div class="container">
            <div class="row">

<?php
    foreach($results as $question){
?>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card" style="width: 60rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $question['title'] ?></h5>
                            <p class="card-text">Publiée par <?php echo $question['firstname'],  $question['creationDate'] ?></p>
                            <p class="card-text"><?php echo $question['content'] ?></p>
                            <a href="question.php?idTopic=<?php echo $idTopic ?>&&idQuestion=<?php echo $question['id'] ?>&&title=<?php echo $question['title'] ?>" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                
                
                
                
<?php
} 
?>

            </div>
        </div>