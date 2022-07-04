<?php
    $title = "Fitness Essential - Salles de Sport";
    $content = "Nos différentes salles de sport";
    $currentPage = 'gym';
    
    require '../../../header.php';

    $pdo = database();

    $reqGym = $pdo->query("SELECT * FROM RkU_GYMS");
    $results = $reqGym->fetchAll();
?>

<h1>Nos différentes salles</h1>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="text-end my-3">
                <a href="<?= DOMAIN . 'modules/gym/vues/addNewGym.php'?>" class="btn btn-primary">Insérer une nouvelle salle de sport</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="gymsTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Surface</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Directeur</th>
                            <th>Numéro de téléphone</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($results as $gym){
                $reqUser = $pdo->prepare("SELECT lastname, firstname FROM RkU_USER WHERE id=:id");
                $reqUser->execute([
                    'id'=>$gym['user']
                ]);
                $ownerName = $reqUser->fetch();

                $reqCity = $pdo->prepare("SELECT name FROM RkU_CITY WHERE id=:id");
                $reqCity->execute([
                    'id'=>$gym['city']
                ]);
                $cityName = $reqCity->fetch();
            ?>
                        <tr>
                            <td class="align-middle"><?php echo $gym['id'];?></td>
                            <td class="align-middle"><?php echo $gym['name'];?></td>
                            <td class="align-middle"><?php echo $gym['surfaceArea'];?> m²</td>
                            <td class="align-middle"><?php echo $gym['address'];?></td>
                            <td class="align-middle"><?php echo $cityName['name'];?></td>
                            <td class="align-middle"><?php echo $ownerName['firstname'] . ' ' . $ownerName['lastname'];?></td>
                            <td class="align-middle"><?php echo $gym['phoneNumber'];?></td>
                        </tr>

            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php
    require '../../../footer.php';