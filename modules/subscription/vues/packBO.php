<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
    }
    
    if(!isset($_GET['packId'])){
        header('Location: ../../../error404.php');
        die();
    }

    require '../../../header.php';
    Message("modifyPack");

    $packId = $_GET['packId'];

    $pdo = database();

    $req = $pdo->prepare("SELECT * FROM RkU_FITCOINS WHERE id=:id");
    $req->execute([
        'id'=>$packId
    ]);
    $pack = $req->fetch();
    ?>


<div class="row d-flex justify-content-center">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminFitcoins.php'?>" role="button">Revenir à la page précedente</a>
        </div>
    <h1 class="aligned-title">Modification d'un pack</h1>
    <form action="../scripts/packModification.php?packId=<?= $packId ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
      <div class="row my-3">
            <div class="form-group">
                <label for="packName">Nom du pack</label>
                <input type="text" name="packName" id="packName" class="form-control" value="<?= $pack['name']; ?>">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="packDescription">Description</label>
                <input type="text" name="packDescription" id="packDescription" class="form-control" value="<?= $pack['description']; ?>">
            </div>
        </div>
        
        <div class="row my-3">
                <div class="form-group">
                    <label for="packPrice">Prix</label>
                    <input type="float" name="packPrice" id="packPrice" class="form-control"  value="<?= $pack['price'] ?>" required>
                </div>
            </div>

        <div class="row my-3">
                <div class="form-group">
                    <label for="packFitcoins">Nombre de fitcoins</label>
                    <input type="number" name="packFitcoins" id="packFitcoins" class="form-control" value="<?= $pack['numberOfFitcoins']; ?>" required>
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
                <button class="btn btn-primary delete-passwordConfirm" name="modifyPack" type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>

<?php
require '../../../footer.php';
?>