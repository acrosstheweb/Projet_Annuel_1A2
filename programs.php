<?php
    $title = "Fitness Essential - Programmes";
    $content = "Les différents programmes de Fitness Essential";
    $currentPage = 'programs';
    require 'header.php';

    $pdo = database();

    $req = $pdo->query("SELECT C.*, P.*, E.*
                        FROM RkU_CONTAINS C
                        LEFT JOIN RkU_PROGRAM P ON C.programId = P.id
                        LEFT JOIN RkU_EXERCICE E ON C.exerciceId = E.id
                            ");

    $results = $req->fetchAll();

// var_dump(sizeof($results)); die();
// echo "<pre>";
// print_r($results); die();

?>

<h1 class="aligned-title"> Qui que vous soyez, nous vous proposons des programmes adaptés à vos envies </h1>

<div class="container-fluid">
    <div class="row d-flex justify-content-around">
        <?php
        $lastProgramId = "";
        foreach($results as $program){
            if (($program['programId'] != $lastProgramId)) { ?>
            
        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/push1.jpg" class="card-img __programImage" alt="push1">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <?php echo "<h5 class='card-title'>".$program['nameProgram'].'</h5>';
            $lastProgramId = $program['programId'];
            }?>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <?php
                                        echo '<tr><td>'.$program['nameExercice'].'</td>';
                                        echo '<td>'.$program['series']. 'x' . $program['repeats'].'</td></tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        






                <!-- if (($program['programId'] != $lastProgramId)) {
                    echo "<tr><td>".$program['nameProgram'].'</td></tr>';
                    $lastProgramId = $program['programId'];
                }
                    echo '<tr><td>'.$program['nameExercice'].'</td>';
                    echo '<td>'.$program['series']. 'x' . $program['repeats'].'</td></tr>';
                    ?> -->

        <?php
            }
        ?>
            
            </tbody>
        </table>

        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/push1.jpg" class="card-img __programImage" alt="push1">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">PUSH #1</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td>Développé couché</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Développé incliné</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Développé militaire</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Tirage menton</td>
                                    <td>3X15</td>
                                </tr>
                                <tr>
                                    <td>Élévation latérale</td>
                                    <td>4X15</td>
                                </tr>
                                <tr>
                                    <td>Oiseau poulie</td>
                                    <td>4X15</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMorePush1" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessPush1" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/legs1.jpg" class="card-img __programImage" alt="legs1">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">LEGS #1</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td>Leg curl</td>
                                    <td>4X20</td>
                                </tr>
                                <tr>
                                    <td>Low squat</td>
                                    <td>4X20</td>
                                </tr>
                                <tr>
                                    <td>Presse inclinée</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Sdt jambes tendues</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Hack squat inversé</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Mollet</td>
                                    <td>4X10</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMoreLegs1" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessLegs1" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/pull2.jpg" class="card-img __programImage" alt="pull2">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">PULL #2</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td>Soulevé de terre convergent</td>
                                    <td>5X5</td>
                                </tr>
                                <tr>
                                    <td>Tirage horizontal</td>
                                    <td>4X8</td>
                                </tr>
                                <tr>
                                    <td>Face pull</td>
                                    <td>4X15</td>
                                </tr>
                                <tr>
                                    <td>Lat pulldown</td>
                                    <td>3X15</td>
                                </tr>
                                <tr>
                                    <td>Tirage vertical serré</td>
                                    <td>4X8</td>
                                </tr>
                                <tr>
                                    <td>Curl poulie</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Curl poulie corde</td>
                                    <td>4X12</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMorePull2" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessPull2" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/push2.jpg" class="card-img __programImage" alt="push2">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">PUSH #2</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td>Développé couché</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Développé incliné</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Écarté sur poulie</td>
                                    <td>3X15</td>
                                </tr>
                                <tr>
                                    <td>Dips</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Extension triceps poulie haute</td>
                                    <td>4X12</td>
                                </tr>
                                <tr>
                                    <td>Extension triceps poulie basse</td>
                                    <td>4X12</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMorePush2" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessPush2" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-dark text-white col-10 col-md-5 col-lg-3 text-center p-0 __programCard">
            <img src="sources/img/legs2.jpg" class="card-img" alt="legs2">
            <div class="card-img-overlay">
                <div class="__programDescription">
                    <div class="__cardDescriptionText p-4">
                        <h5 class="card-title">LEGS #2</h5>
                        <table class="table text-light card-text __programContent">
                            <tbody>
                                <tr>
                                    <td>Leg extension</td>
                                    <td>4X20</td>
                                </tr>
                                <tr>
                                    <td>Squat</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Presse incliné serré</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Fentes smith machine</td>
                                    <td>3X10</td>
                                </tr>
                                <tr>
                                    <td>Hack squat</td>
                                    <td>4X10</td>
                                </tr>
                                <tr>
                                    <td>Mollet</td>
                                    <td>4X10</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" id="__seeMoreLegs2" class="btn btn-primary __programControl">Voir plus</a>
                        <a href="#" id="__seeLessLegs2" class="btn btn-primary __programControl">Voir moins</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php
    include 'footer.php';
?>