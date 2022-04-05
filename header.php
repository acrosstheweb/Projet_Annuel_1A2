<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content=<?php if(isset($content)){echo $content;}else{echo 'Fitness Essential';} ?>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php if(isset($title)){echo $title;}else{echo 'Fitness Essential';} ?></title>
</head>
<body>

<?php
    include "register.php";
    include "login.php";

    function isActive($active_page, $link){
        if($active_page == $link){
            echo "active";
        }
    }
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light" id="nav-main" role="navigation">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"index");} ?>" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"about");} ?>" href="about.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"gyms");} ?>" href="gyms.php">Salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"reservations");} ?>" href="reservations.php">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"subscriptions");} ?>" href="subscriptions.php">Abonnements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"programs");} ?>" href="programs.php">Programmes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,"forum");} ?>" href="forum.php">Forum</a>
                    </li>
                </ul>
                
                <form class="d-flex col-2" id="search-bar">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Rechercher" aria-label="Rechercher">
                        <button class="btn btn-outline-success" type="submit">
                        <span class="material-icons">search</span>
                        </button>
                    </div>
                </form>

                <ul class="navbar-nav" id="login-group">
                    <!-- <li class="nav-item"> // Bouton de l'utilisateur lorsqu'il est connecté
                            <a class="nav-link" href="#" id='user-profile-button'><img src="sources/img/avatar.jpg" id='img-default-avatar' alt="Avatar"></a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="login-trigger" href="#" data-bs-toggle="modal" data-bs-target="#login-modal">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-trigger"  href="#" data-bs-toggle="modal" data-bs-target="#register-modal">Inscription</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<aside class="col-3" id="user-slide">
    jaaj
</aside>

<div class="modal fade" id="login-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Connexion</h3>
                <button type="button" class="btn button-close-modal" data-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true" class="span-close-modal">&times;</span>
                </button>
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
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary">Se connecter</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="register-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Inscription</h3>
                <button type="button" class="btn button-close-modal" data-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true" class="span-close-modal">&times;</span>
                </button>
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
                                <option value="3">Ne se prononce pas</option>
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
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary">S'inscrire</button>
            </div>
        </div>
    </div>
</div>


<script src="js/user-slide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>