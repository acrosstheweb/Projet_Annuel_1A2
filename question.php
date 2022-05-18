<?php
    $title = "Fitness Essential - Question";
    $content = "Le forum de Fitness Essential";
    $currentPage = 'forum';
    require 'header.php';
    Message('UploadImage');
    
    $idTopic = $_GET['idTopic'];
    $idQestion = $_GET['idQuestion'];

    if(empty($idTopic) || empty($idQestion)){
        header('Location: /forum');
        die();
    }

    $pdo = database();

    $req = $pdo->query("SELECT q.*, DATE_FORMAT(q.creationDate, ' le %d/%m/%Y à %Hh%i') as creationDate, U.firstname
                            FROM RkU_QUESTION Q
                            LEFT JOIN RkU_USER U ON Q.userID = U.id
                            WHERE q.topic = $idTopic AND q.id = $idQestion
                            ORDER BY q.creationDate DESC",
                        );

    $results = $req->fetch();

    if(!isset($results['id'])){
        header('Location: /forum/' . $idTopic);
        die();
      }  

?>


<div class="container">
    <div class="row">
        
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="center aligned-title"> <?php echo $results["title"] ?> </h2>

            <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px">
                <h3>Question</h3>

                <div style="border-top: 2px solid #eee; padding: 10px 0">
                    <?php echo $results["content"] ?> <br>
                </div>

                <div style="color: #CCC; font-size: 10px; text-align: right">
                    <?php echo $results["creationDate"] ?> par <?php echo $results["firstname"] ?>
                </div>
            </div>
        </div>
                

    </div>
</div>