<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';

    require_once '../../../functions.php';
    if(!isAdmin()){
        header('Location: ../../../error404.php');
        die();
    }
    
    if(!isset($_GET['subscriptionId'])){
        header('Location: ../../../error404.php');
        die();
    }

    require '../../../header.php';
    Message("modifySubscription");

    $subscriptionId = htmlspecialchars($_GET['subscriptionId']);

    $pdo = database();

    $req = $pdo->prepare("SELECT * FROM RkU_SUBSCRIPTION WHERE id=:id");
    $req->execute([
        'id'=>$subscriptionId
    ]);
    $subscription = $req->fetch();
    ?>


<div class="row d-flex justify-content-center">
        <div class="col">
            <a class="btn btn-primary" href="<?= DOMAIN . 'modules/user/vues/admin/adminSubscription.php'?>" role="button">Revenir à la page précedente</a>
        </div>
    <h1 class="aligned-title">Modification d'un abonnement</h1>

    <form action="../scripts/subscriptionModification.php?subscriptionId=<?= $subscriptionId ?>" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
      <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionName">Nom du pack</label>
                <input type="text" name="subscriptionName" id="subscriptionName" class="form-control" value="<?= $subscription['name']; ?>">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionContent">Description</label>
                <input type="text" name="subscriptionContent" id="subscriptionContent" class="form-control" value="<?= $subscription['content']; ?>">
            </div>
        </div>
        
        <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionPrice">Prix</label>
                <input type="number" step="any" name="subscriptionPrice" id="subscriptionPrice" class="form-control"  value="<?= $subscription['price'] ?>" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionFirstAttribut">Attribut 1</label>
                <input type="text" name="subscriptionFirstAttribut" id="subscriptionFirstAttribut" class="form-control" value="<?= $subscription['firstAttribut']; ?>" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionSecondAttribut">Attribut 2</label>
                <input type="text" name="subscriptionSecondAttribut" id="subscriptionSecondAttribut" class="form-control" value="<?= $subscription['secondAttribut']; ?>" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="subscriptionThirdAttribut">Attribut 3</label>
                <input type="text" name="subscriptionThirdAttribut" id="subscriptionThirdAttribut" class="form-control" value="<?= $subscription['thirdAttribut']; ?>" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <label for="modify-adminPasswordInput" class="fw-bold">Votre mot de passe</label>
                <input id="modify-adminPasswordInput" class="form-control" type="password" name="modify-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
            </div>
        </div>

        <div class="row my-3">
            <div class="form-group">
                <button class="btn btn-primary delete-passwordConfirm" name="modifySubscription" type="submit">Modifier</button>
            </div>
        </div>
    </form>
</div>

<?php
require '../../../footer.php';