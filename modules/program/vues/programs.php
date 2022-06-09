<?php
    $title = "Fitness Essential - Programmes";
    $content = "Les différents programmes de Fitness Essential";
    $currentPage = 'programs';
    require '../../../header.php';

    $pdo = database();

    $req = $pdo->query("SELECT C.*, P.*, E.*
                        FROM RkU_CONTAINS C
                        LEFT JOIN RkU_PROGRAM P ON C.programId = P.id
                        LEFT JOIN RkU_EXERCICE E ON C.exerciceId = E.id
                            ");

    $results = $req->fetchAll();

?>

<h1 class="aligned-title"> Qui que vous soyez, nous vous proposons des programmes adaptés à vos envies </h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-around">

        <?php
        $lastProgramId = "";
        foreach($results as $program){
            if ($program == $results[0]){
        ?>
            
        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="<?= DOMAIN . $program['illustration'] ?>" class="card-img __programImage" alt="push1">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">

                        <?php
                        echo "<h5 class='card-title text-uppercase'>".$program['nameProgram'].'</h5>';
                        $lastProgramId = $program['programId'];
                        ?>

                        <table class="table text-light card-text __programContent">
                            <tbody>

            <?php
            }
            elseif (($program['programId'] != $lastProgramId)) {
            ?>
            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="<?= DOMAIN . $program['illustration'] ?>" class="card-img __programImage" alt="push1">
            <div class="card-img-overlay __programOverlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">

                        <?php
                        echo "<h5 class='card-title text-uppercase'>".$program['nameProgram'].'</h5>';
                        $lastProgramId = $program['programId'];
                        ?>

                        <table class="table text-light card-text __programContent">
                            <tbody>
            <?php
            }
            ?>
                                <?php
                                echo '<tr><td>'.$program['nameExercice'].'</td>';
                                echo '<td>'.$program['series']. 'x' . $program['repeats'].'</td></tr>';
                                ?>
                                
        <?php
        }
        ?>
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include '../../../footer.php';
?>