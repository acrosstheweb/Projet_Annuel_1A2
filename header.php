<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content=<?php if (isset($content)) {
                                            echo $content;
                                        } else {
                                            echo "Bienvenue sur Fitness Essential";
                                        } ?>>
    <link rel="icon" type="image/x-icon" href="sources/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php if (isset($title)) {
                echo $title;
            } else {
                echo "Fitness Essential";
            } ?></title>
</head>

<body>

    <?php
    include "register.php";
    include "login.php";

    function isActive($active_page, $link)
    {
        if ($active_page == $link) {
            echo "active";
        }
    }
    ?>

    <header class="sticky-top">

        <!-- Nativement, avec la classe 'navbar', les éléments enfants de la nav utilisent
flex, par défaut -> 'justify-content: space-between'  -->

        <!-- Création de la navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">
                    <img src="sources/img/logo.png" alt="logo">
                </a>

                <!-- Création du burger menu  -->
                <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenu de la navbar -->
                <!-- NE PAS METTRE D'ESPACE DANS LES NOMS DES DIFFÉRENTES PAGES -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "gyms");
                                                } ?>" href="gyms.php">Salles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "subscriptions");
                                                } ?>" href="subscriptions.php">Abonnements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "reservations");
                                                } ?>" href="reservations.php">Réservations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "programs");
                                                } ?>" href="programs.php">Programmes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "forum");
                                                } ?>" href="forum.php">Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($currentPage)) {
                                                    isActive($currentPage, "about");
                                                } ?>" href="about.php">Informations</a>
                        </li>
                    </ul>

                    <!-- Barre de recherche et bouton recherche + bouton inscription & connexion-->
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" id="__login-trigger" href="#login-modal" role="button">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="__register-trigger" href="#register-modal" role="button">Inscription</a>
                        </li>
                        <li class="nav-item __research-bar">
                            <form action="#" class="d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Rechercher" aria-label="Search" aria-describedby="Search">
                                    <button class="input-group-text" id="Search"><span class="material-icons">search</span></button>
                                </div>
                            </form>
                        </li>
                    </ul>

                    <!-- </div> -->

                    <!-- Il faudra penser à rajouter le petit panier ici -->

                </div>
            </div>
        </nav>

    </header>

    <!-- Modales INSCRIPTION / CONNEXION -->

    <div class="modal" id="__login-modal" aria-hidden="true" aria-labelledby="login-modal-label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-modal-label">Connexion</h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-3"></div>
                    <form action="" class="col-6">
                        <label for="login-email">Adresse mail : </label>
                        <input class="form-control" type="email" name="login-email" id="login-email" placeholder="Adresse mail"><br>

                        <label for="login-password">Mot de passe : </label>
                        <input class="form-control" type="password" name="login-password" id="login-password" placeholder="Mot de passe">
                    </form>
                    <div class="col-3"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="__close-login-modal" aria-label="Close">Annuler</button>
                    <button class="btn btn-secondary">Inscription</button>
                    <button class="btn btn-primary">Connexion</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="__register-modal" aria-hidden="true" aria-labelledby="register-modal-label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal-label">Inscription</h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col">
                                <label for="register-gender">Civilité :</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected disabled>Veuillez choisir</option>
                                    <option value="1">Homme</option>
                                    <option value="2">Femme</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="register-password">Date de naissance : </label>
                                <input class="form-control" type="date" name="register-birthday"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-email">Nom : </label>
                                <input class="form-control" type="text" name="register-lastname" placeholder="Nom">
                            </div>

                            <div class="col">
                                <label for="register-password">Prénom : </label>
                                <input class="form-control" type="text" name="register-firstname" placeholder="Prénom"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-email">Email : </label>
                                <input class="form-control" type="email" name="register-email" placeholder="Adresse mail">
                            </div>

                            <div class="col">
                                <label for="register-password">Adresse : </label>
                                <input class="form-control" type="text" name="register-address" placeholder="Adresse"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-email">Ville : </label>
                                <input class="form-control" type="text" name="register-city" placeholder="Ville">
                            </div>

                            <div class="col">
                                <label for="register-password">Code postal : </label>
                                <input class="form-control" type="password" name="register-zip-code" placeholder="Code postal"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-email">Mot de passe : </label>
                                <input class="form-control" type="email" name="register-password" placeholder="Mot de passe">
                            </div>

                            <div class="col">
                                <label for="register-password">Confirmation mot de passe : </label>
                                <input class="form-control" type="password" name="register-confirmed-password" placeholder="Confirmation du mot de passe"><br>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id=" __close-register-modal" aria-label="Close">Annuler</button>
                    <button class="btn btn-secondary">Connexion</button>
                    <button class="btn btn-primary">Inscription</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/modals.js"></script>