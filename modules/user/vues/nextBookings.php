<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Mes prochaines séances";
    $content = "Mes prochaines séances";
    $currentPage = 'nextBookings';
    require '../../../header.php';
    Message('Update');
    Message("inscriptionEvent");
    Message("eventDesinscription");
    
    $pdo = database();

    $req = $pdo->prepare("SELECT P.*, B.*, U.*
                        FROM RkU_PARTICIPATE P
                        LEFT JOIN RkU_USER U ON P.userId = U.id
                        LEFT JOIN RkU_BOOKING B ON P.eventId = B.id
                        WHERE B.endDate > :today
                        AND U.id = :userId
                            ");
    
    $req->execute([
        'today' => date('Y-m-d h:i:s',),
        'userId' => $_SESSION['userId']
    ]);

    $results = $req->fetchAll();
?>
<div class="container-fluid d-lg-none">
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

<h2 class="aligned-title"> Mes prochaines séances </h2>
<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "profilePageNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            <?php
                if (empty($results)){
            ?>

                    <div class="row text-center">
                        <p>Vous n'avez aucune séance de prévue pour l'instant.<br></p>
                    </div>

                    <div class="text-center">
                        <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php'?>" class="btn btn-primary">Réserver une séance</a>
                    </div>
            
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
                                <th>Action</th>
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
                                <td class="align-middle">
                                    <a href="#" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteBooking<?= $booking['id'];?>"><i class="fa-solid fa-user-minus"></i><span class="d-none d-lg-inline"> Ne plus participer</span></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteBooking<?= $booking['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ne plus participer à une séance</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="deleteBooking<?= $booking['id'];?>" action="" method="POST" >
                                                <div class="deleteFormInfo">
                                                    <h5>Vous êtes sur le point de vous désincrire à cette séance :</h5>
                                                    <div class="text-uppercase fw-bold mt-2">
                                                        Nom : <br>
                                                    </div>
                                                    <?= $booking['name'];?><br>

                                                    <div class="text-uppercase fw-bold mt-2">
                                                        Date : <br>
                                                    </div>
                                                    <?= (new \DateTime($booking['startDate']))->format('d/m/Y'); ?> à <?= (new \DateTime($booking['startDate']))->format('H:i'); ?> 
                                                        au  <?= (new \DateTime($booking['endDate']))->format('d/m/Y'); ?> à <?= (new \DateTime($booking['endDate']))->format('H:i'); ?><br>

                                                    <div class="text-uppercase fw-bold mt-2">
                                                        Prix : <br>
                                                    </div>
                                                    <p class="d-flex align-items-center"><?= $booking['price'];?> <img class="mx-1" src="<?= DOMAIN . 'sources/img/fitcoin.svg' ?>" width="14px" height="14px" alt=""></p>
                                                    <div class="text-muted small">
                                                        Si ce désistement respecte les Conditions Générales de Vente, vous serez recrédité le montant que vous avez payé. <br>
                                                    </div>
                                                </div>
                                                <div class="row delete-userPassword mt-3">
                                                    <div class="col">
                                                        <label for="delete-userPasswordInput" class="fw-bold">Pour confirmer, veuillez saisir votre mot de passe</label>
                                                        <input id="delete-userPasswordInput" class="form-control" type="password" name="delete-userPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button class="btn btn-primary delete-passwordConfirm" form="deleteBooking<?= $booking['id'];?>" type="submit">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php } ?>
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