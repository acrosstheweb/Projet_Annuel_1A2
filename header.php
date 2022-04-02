<?php
    include 'register.php';
    include 'login.php';

    function isActive($active_page, $link){
        if($active_page == $link){
            echo 'active';
        }
    }
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light" id='nav-main' role='navigation'>
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'index');} ?>" aria-current="page" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'about');} ?>" href="about.php">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'gyms');} ?>" href="gyms.php">Salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'reservations');} ?>" href="reservations.php">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'subscriptions');} ?>" href="subscriptions.php">Abonnements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'programs');} ?>" href="programs.php">Programmes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($currentPage)){isActive($currentPage,'forum');} ?>" href="forum.php">Forum</a>
                    </li>
                </ul>
                
                <form class="d-flex col-2">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Rechercher" aria-label="Rechercher">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </div>
                </form>

                <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link" href="#" id='user-profile-button'><img src="sources/img/avatar.jpg" id='img-default-avatar' alt="Avatar"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<aside class='col-3' id='user-slide'>
    jaaj
</aside>

<script src="js/user-slide.js"></script>