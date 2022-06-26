<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Historique de mes séances";
    $content = "Historique de mes séances";
    $currentPage = 'pastBookings';
    require '../../../header.php';
    Message('Update');
    
    $pdo = database();

    $req = $pdo->prepare("SELECT P.*, B.*, U.*
                        FROM RkU_PARTICIPATE P
                        LEFT JOIN RkU_USER U ON P.userId = U.id
                        LEFT JOIN RkU_BOOKING B ON P.eventId = B.id
                        WHERE B.endDate < :today
                        AND U.id = :userId
                            ");
    
    $req->execute([
        'today' => date('Y-m-d h:i:s',),
        'userId' => $_SESSION['userId']
    ]);

    $results = $req->fetchAll();
?>
<div class="container-fluid d-md-none">
    <div class="row __profileDropdown">
        <div class="dropdown d-grid gap-2">
            <button class="btn dropdown-toggle text-light" type="button" id="__profileDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $content ?>
            </button>
            <ul class="dropdown-menu justify-content-center __profileDropdownMenu text-light" aria-labelledby="dropdownMenuButton1">
                <?php include 'profilePageNavbar.php'; ?>
            </ul>
        </div>
    </div>
</div>

<h2 class="aligned-title"> Historique de mes séances </h2>
<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include 'profilePageNavbar.php'; ?>
        </div>
        
        <div class="col-12 col-md-8">
            <?php
                if (empty($results)){
            ?>

                    <div class="row text-center">
                        <p>Vous n'avez aucune pas encore participé à une séance.<br></p>
                    </div>

                    <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php'?>" class="btn btn-primary">Réservez une séance</a>
            
            <?php 
                } else {
            ?>
                <div class="table-responsive">
                    <table class="table" id="eventsTable">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Description</th>
                                <th>Salle</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                    foreach($results as $booking){

                        $reqGym = $pdo->prepare("SELECT name FROM RkU_GYMS WHERE id=:id");
                        $reqGym->execute([
                            'id'=>$booking['gym']
                        ]);
                        $GymName = $reqGym->fetch()['name'];
                ?>
                            <tr>
                                <td class="align-middle"><?php echo $booking['name'];?></td>
                                <td class="align-middle"><?php echo $booking['startDate'];?></td>
                                <td class="align-middle"><?php echo $booking['endDate'];?></td>
                                <td class="align-middle"><?php echo $booking['description'];?></td>
                                <td class="align-middle"><?php echo $GymName;?></td>
                            </tr>
                <?php 
                    }
                ?>
                        </tbody>
                    </table>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php
    include '../../../footer.php';
?>