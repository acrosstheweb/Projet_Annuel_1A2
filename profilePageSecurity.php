<?php
require 'functions.php';
if(!isConnected()){
    header('Location: error404.php');
    die();
}
$title = "Fitness Essential - Page profil Sécurité";
$content = "Profil utilisateur";

require 'header.php';
$db = database();
$getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email FROM rku_user WHERE id=:id");
$getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
$user = $getUserInfoQuery->fetch();
Message('DeleteUser');
?>

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <nav class="nav flex-column py-3">
                <a class="nav-link active" aria-current="page" href="profilePage.php">Mon Profil</a>
                <a class="nav-link" href="profilePageSecurity.php">Sécurité</a>
                <a class="nav-link" href="#">jaaj 1</a>
                <a class="nav-link disabled">jaaj 2</a>
            </nav>
        </div>
        <div class="col-12 col-md-8">

            <div class="row border-bottom py-3 mb-3">
                <div class="col-8">
                    <p class="d-flex align-items-start fw-bold fs-3">
                        <?php
                        echo isset($user['firstName']) && isset($user['lastName']) ? $user['firstName'] . ' ' . $user['lastName'] : ''
                        ?>
                    </p>
                    <a href="#" class="link-primary" id="__profileInfoModify--trigger">Modifier mes informations</a>
                </div>
            </div>

            <div class="row">
                <form id="modifyProfile" method="POST" action="">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="profileEmail" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Adresse e-mail</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                    echo $user['email'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileEmail" value="<?php echo $user['email'] ?? '' ?>" required="required">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="profileEmail" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Mot de passe</p>
                                <p class="my-0 __profileInfoValue">
                                    **************
                                </p>
                            </label>
                            <input type="password" class="form-control __profileInfoInput" name="profilePassword" value="" required="required">
                        </div>
                    </div>

                    <a href="userDel.php" class="btn btn-danger mt-5" data-bs-toggle="modal" data-bs-target="#delModal">Supprimer mon compte</a>
                    <a href="exportDataRGPD.php" class="btn btn-secondary mt-5">Export données RGPD</a>

                    <a href="profilePageSecurity.php" class="btn btn-secondary mt-5" id="__profileInfoCancel"">Annuler les modifications</a>
                    <button form="modifyProfile" class="btn btn-primary mt-5" id="__profileInfoSubmit">Enregistrer les modifications</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression d'un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteUserForm" action="userDel.php" method="POST" >
                    <div class="deleteFormInfo">
                        <h5>Vous êtes sur le point de supprimer votre compte Fitness Essential :</h5>
                        <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le supprimer?</p>
                    </div>
                    <div class="row deletePassword">
                        <div class="col">
                            <label for="userPassword" class="fw-bold">Mot de passe </label>
                            <input id="userPassword" class="form-control" type="password" name="userPassword" placeholder="Veuillez saisir votre mot de passe" required="required">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <!--<button class="btn btn-primary delete-passwordConfirm">Supprimer</button>-->
                <button class="btn btn-primary <!--delete-confirm-->" form="deleteUserForm" type="submit">Supprimer</button>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include 'footer.php';
?>

<script src="js/profileInfo-modify.js" crossorigin="anonymous"></script>