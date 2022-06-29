<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Page profil";
    $content = "Profil utilisateur";

    require '../../../header.php';
    Message('Update');
    $db = database();
    $getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email, civility, avatar, address, city, zipCode, birthday, registrationDate FROM RkU_USER WHERE id=:id");
    $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
    $user = $getUserInfoQuery->fetch();
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

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row d-flex justify-content-center justify-content-lg-start">
        <div class="d-none col-2 d-lg-flex justify-content-center">
            <?php include "profilePageNavbar.php"; ?>
        </div>

        <div class="col-12 col-md-10 col-lg-8">

            <div class="row border-bottom py-3 mb-3 __profilePicRow">
                <!-- <img src="sources/img/avatar.jpg" alt="" class="img-fluid "> -->
                <div class="card col-4 col-md-3 col-lg-2 __profilePic">
                    <?php 
                    if ($user['avatar'] == 0){
                        echo '<img src="' . DOMAIN . 'sources/img/avatar.jpg" class="card-img" alt="avatar">';
                    } else {
                        echo '<img src="' . DOMAIN . 'sources/avatar/finished/' . $user['avatar'] . '" class="card-img" alt="avatar">';
                    }
                    ?>
                    
                    <div class="card-img-overlay text-center d-flex align-items-end">
                        <div class="__profilePicOverlay">
                            <div class="__profilePicChange">
                                <a href="<?= DOMAIN . 'modules/user/vues/avatar_v2.php' ?>" class="text-white">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <p class="d-md-flex align-items-start fw-bold fs-3">
                        <?php
                            echo isset($user['firstName']) && isset($user['lastName']) ? $user['firstName'] . ' ' . $user['lastName'] : ''
                        ?>
                    </p>
                    <p class="d-md-flex align-items-end">
                        <a href="#" class="link-primary" id="__profileInfoModify--trigger">Modifier mes informations</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <form id="modifyProfile" method="POST" action="../scripts/updateprofile.php">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileCivility" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel  text-uppercase">Civilité</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo isset($user['civility']) ? ($user['civility'] == 'M')?'Monsieur':'Madame' : ''
                                    ?>
                                </p>
                            </label>
                            <select id="profileCivility" class="form-select __profileInfoInput" name="profileCivility" aria-label="Default select example" required="required">
                                <option value="M">Monsieur</option>
                                <option value="F">Madame</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileFirstName" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Prénom</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['firstName'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileFirstName" id="profileFirstName" value="<?php echo $user['firstName'] ?? '' ?>" required="required">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileLastName" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Nom</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['lastName'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileLastName" id="profileLastName" value="<?php echo $user['lastName'] ?? '' ?>" required="required">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileEmail" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Adresse e-mail</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['email'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileEmail" id="profileEmail" value="<?php echo $user['email'] ?? '' ?>" required="required" disabled="disabled">
                            <br>
                            <small class="form-text text-muted ">La modification de l'adresse e-mail s'effectue dans l'onglet Sécurité</small>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileBirthDate" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Date de naissance</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['birthday'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="date" class="form-control __profileInfoInput" name="profileBirthDate" id="profileBirthDate" value="<?php echo $user['birthday'] ?? '' ?>" required="required">
                        </div>
                    </div>
                    

                    <div class="row mt-5">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileAddress" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Adresse</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['address'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileAddress" id="profileAddress" value="<?php echo $user['address'] ?? '' ?>" required="required">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileZipCode" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Code Postal</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['zipCode'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileZipCode" id="profileZipCode" value="<?php echo $user['zipCode'] ?? '' ?>" required="required">
                        </div>
                    
                        <div class="col-12 col-md-6 mb-3">
                            <label for="profileCity" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel text-uppercase">Ville</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['city'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileCity" id="profileCity" value="<?php echo $user['city'] ?? '' ?>" required="required">
                        </div>
                    </div>
                    <a href="" class="btn btn-secondary mt-5" id="__profileInfoCancel">Annuler les modifications</a>
                    <button form="modifyProfile" class="btn btn-primary mt-5" id="__profileInfoSubmit">Enregistrer les modifications</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php
    include '../../../footer.php';
?>

<script src="<?= DOMAIN . 'js/profileInfo-modify.js'?>" crossorigin="anonymous"></script>