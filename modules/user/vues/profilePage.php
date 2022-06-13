<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Page profil";
    $content = "Profil utilisateur";
    $currentPage = 'profile';
    require '../../../header.php';
    Message('Update');
    $db = database();
    $getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email, civility, avatar, address, city, zipCode, birthday, registrationDate FROM RkU_USER WHERE id=:id");
    $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
    $user = $getUserInfoQuery->fetch();
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
                    <p class="d-flex align-items-start fw-bold fs-3">
                        <?php
                            echo isset($user['firstName']) && isset($user['lastName']) ? $user['firstName'] . ' ' . $user['lastName'] : ''
                        ?>
                    </p>
                    <p class="d-flex align-items-end">
                        <a href="#" class="link-primary" id="__profileInfoModify--trigger">Modifier mes informations</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <form id="modifyProfile" method="POST" action="../scripts/updateprofile.php">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="profileCivility" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Civilité</p>
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
                        <div class="col-6 mb-3">
                            <label for="profileFirstName" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Prénom</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['firstName'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileFirstName" id="profileFirstName" value="<?php echo $user['firstName'] ?? '' ?>" required="required">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="profileLastName" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Nom</p>
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
                        <div class="col-6 mb-3">
                            <label for="profileEmail" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Adresse e-mail</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['email'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileEmail" id="profileEmail" value="<?php echo $user['email'] ?? '' ?>" required="required" disabled="disabled">
                            <br>
                            <small class="form-text text-muted __profileInfoInput">La modification de l'adresse e-mail s'effectue dans l'onglet Sécurité</small>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="profileBirthDate" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Date de naissance</p>
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
                        <div class="col-6 mb-3">
                            <label for="profileAddress" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Adresse</p>
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
                        <div class="col-6 mb-3">
                            <label for="profileZipCode" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Code Postal</p>
                                <p class="my-0 __profileInfoValue">
                                    <?php
                                        echo $user['zipCode'] ?? ''
                                    ?>
                                </p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" name="profileZipCode" id="profileZipCode" value="<?php echo $user['zipCode'] ?? '' ?>" required="required">
                        </div>
                    
                        <div class="col-6 mb-3">
                            <label for="profileCity" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Ville</p>
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