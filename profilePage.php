<?php
    $title = "Fitness Essential - Page profil";
    $content = "Profil utilisateur";
    $currentPage = 'profile';
    include 'header.php';
?>

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <nav class="nav flex-column py-3">
                <a class="nav-link active" aria-current="page" href="#">Mon Profil</a>
                <a class="nav-link" href="#">Sécurité</a>
                <a class="nav-link" href="#">jaaj 1</a>
                <a class="nav-link disabled">jaaj 2</a>
            </nav>
        </div>
        <div class="col-12 col-md-8">

            <div class="row border-bottom py-3 mb-3">
                <!-- <img src="sources/img/avatar.jpg" alt="" class="img-fluid "> -->
                <div class="card col-4 col-md-3 col-lg-2 __profilePic">
                    <img src="sources/img/avatar.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay text-center d-flex align-items-end">
                        <div class="__profilePicOverlay">
                            <div class="__profilePicChange">
                                <a href="#" class="text-white">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <p class="d-flex align-items-start fw-bold fs-3">Jean Bombeur</p>
                    <p class="d-flex align-items-end">
                        <a href="#" class="link-primary" id="__profileInfoModify--trigger">Modifier mes informations</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <form>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="profileCivility" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Civilité</p>
                                <p class="my-0 __profileInfoValue">Monsieur</p>
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
                                <p class="my-0 __profileInfoValue">Jean</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileFirstName" value="Jean" required="required">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="profileLastName" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Nom</p>
                                <p class="my-0 __profileInfoValue">Bombeur</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileLastName" value="Bombeur" required="required">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="profileEmail" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Adresse e-mail</p>
                                <p class="my-0 __profileInfoValue">jean.bombeur@jaaj.fr</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileEmail" value="jean.bombeur@jaaj.fr" required="required">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="profileBirthDate" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Date de naissance</p>
                                <p class="my-0 __profileInfoValue">1969-04-20</p>
                            </label>
                            <input type="date" class="form-control __profileInfoInput" id="profileBirthDate" value="1969-04-20" required="required">
                        </div>
                    </div>
                    

                    <div class="row mt-5">
                        <div class="col-6 mb-3">
                            <label for="profileAddress" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Adresse</p>
                                <p class="my-0 __profileInfoValue">jaaj</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileAddress" value="jaaj" required="required">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="profileZipCode" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Code Postal</p>
                                <p class="my-0 __profileInfoValue">12345</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileZipCode" value="12345" required="required">
                        </div>
                    
                        <div class="col-6 mb-3">
                            <label for="profileCity" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Ville</p>
                                <p class="my-0 __profileInfoValue">Jaaj</p>
                            </label>
                            <input type="text" class="form-control __profileInfoInput" id="profileCity" value="Jaaj" required="required">
                        </div>
                    </div>

                    <button type="cancel" class="btn btn-secondary mt-5" id="__profileInfoCancel">Annuler les modifications</button>
                    <button type="submit" class="btn btn-primary mt-5" id="__profileInfoSubmit">Enregistrer les modifications</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>

<script src="js/profileInfo-modify.js" crossorigin="anonymous"></script>