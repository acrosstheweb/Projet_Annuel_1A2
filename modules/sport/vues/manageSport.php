<?php
    $title = "Fitness Essential - Sport";
    $content = "Modifier un sport";
    $currentPage = 'Back Office';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
    }
    
    if(!isset($_GET['sportId'])){
        header('Location: ../../../error404.php');
        die();
    }

    $sportId = htmlspecialchars($_GET['sportId']);

    require '../../../header.php';
    Message("modifySport");

    $pdo = database();
                        
    $req = $pdo->prepare("SELECT * FROM RkU_SPORT WHERE id=:id");
    $req->execute([
        'id'=>$sportId
    ]);
    $sport = $req->fetch();

    ?>


<div class="row d-flex justify-content-center">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminSports.php'?>" role="button">Revenir à la page précedente</a>
        </div>
    <h1 class="aligned-title">Modification d'un sport</h1>
    <form action="../scripts/modifySport.php?sportId=<?= $sport['id'] ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
      <div class="row my-3">
            <div class="form-group">
                <label for="sportName">Nom</label>
                <input type="text" name="sportName" id="sportName" class="form-control" value="<?= $sport['name']; ?>">
            </div>
        </div>
        <div class="row my-3">
            <div class="form-group">
                <label for="sportDescription">Description</label>
                <textarea name="sportDescription" id="sportDescription" class="form-control"><?= $sport['description']; ?></textarea>
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
                <button class="btn btn-primary delete-passwordConfirm" name="modifySport" type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>

<?php
require '../../../footer.php';
?>