<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
    }
    
    if(!isset($_GET['gymId'])){
        header('Location: ../../../error404.php');
        die();
    }

    require '../../../header.php';
    Message("modifyGym");

    $gymId = $_GET['gymId'];

    $pdo = database();

    $req = $pdo->prepare("SELECT * FROM RkU_GYMS WHERE id=:id");
    $req->execute([
        'id'=>$gymId
    ]);
    $gym = $req->fetch();
    
    $reqOwner = $pdo->prepare("SELECT id, firstname, lastname FROM RkU_USER WHERE id=:id");
    $reqOwner->execute([
        'id'=>$gym['user']
    ]);
    $owner = $reqOwner->fetch();

    $reqCity = $pdo->prepare("SELECT name FROM RkU_CITY WHERE id=:id");
    $reqCity->execute([
        'id'=>$gym['city']
    ]);
    $city = $reqCity->fetch()['name'];

    $queryUsers = $pdo->query("SELECT id, firstname, lastname FROM RkU_USER");
    $users = $queryUsers->fetchAll();

    $queryCities = $pdo->query("SELECT id, name FROM RkU_CITY");
    $cities = $queryCities->fetchAll();
    ?>


<div class="row d-flex justify-content-center">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminGyms.php'?>" role="button">Revenir à la page précedente</a>
        </div>
    <h1 class="aligned-title">Modification d'une salle de sport</h1>
    <form action="../scripts/gymModification.php?gymId=<?= $gymId ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
      <div class="row my-3">
            <div class="form-group">
                <label for="gymName">Nom de la salle</label>
                <input type="text" name="gymName" id="gymName" class="form-control" value="<?= $gym['name']; ?>">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="gymArea">Surface</label>
                <input type="number" name="gymArea" id="gymArea" class="form-control" value="<?= $gym['surfaceArea']; ?>">
            </div>
        </div>
        
        <div class="row my-3">
            <div class="form-group">
                <label for="gymOwner">Directeur</label>
                <select class="form-select" name="gymOwner" id="gymOwner"><br>
                    <option default value="<?= $gym['user'] ?>"><?= $owner['firstname'] ?> <?= $owner['lastname'] ?></option>
                    <?php 
                        foreach($users as $user){
                            $reqUser = $pdo->prepare("SELECT lastname, firstname FROM RkU_USER");
                            $reqUser->execute([
                                'id'=>$gym['user']
                            ]);
                            $ownerName = $reqUser->fetch();
                    ?>
                        <option value="<?= $owner['id'] ?>"> <?= $owner['firstname'] . ' ' . $owner['lastname'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="gymCity">Ville</label>
                <select class="form-select" name="gymCity" id="gymCity"><br>
                    <option default value="<?= $gym['city'] ?>"><?= $city ?></option>
                    <?php 
                        foreach($cities as $city){
                    ?>
                        <option value="<?= $cities['id'] ?>"> <?= $city['name'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="gymAddress">Adresse de la salle</label>
                <input type="text" name="gymAddress" id="gymAddress" class="form-control"  value="<?= $gym['address'] ?>" required>
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="gymPhone">Numéro de téléphone</label>
                <input type="number" name="gymPhone" id="gymPhone" class="form-control" value="<?= $gym['phoneNumber']; ?>" required>
            </div>
        </div>

        <?php
            $mapPath = $gym['link'];
            $mapPath = str_replace('https://maps.google.com/maps?q=', '', $mapPath);
            $mapPath = str_replace('&t=&z=13&ie=UTF8&iwloc=&output=embed', '', $mapPath);
            $mapPath = str_replace('%20', ' ', $mapPath);
        ?>

        <div class="row my-3">
            <div class="form-group">
                <label for="gymMap">Recherche Google Maps</label>
                <input type="text" name="gymMap" id="gymMap" class="form-control" value="<?= $mapPath ?>" required>
            </div>
        </div>
            
        <div class="row my-3">
            <div class="form-group">
                <label for="delete-userPasswordInput" class="fw-bold">Votre mot de passe</label>
                <input id="delete-userPasswordInput" class="form-control" type="password" name="delete-userPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <button class="btn btn-primary delete-passwordConfirm" name="modifyGym" type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>

<?php
require '../../../footer.php';
?>