<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="m_icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="m_style.css">
    <script src="https://kit.fontawesome.com/17a81231c9.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    function isActive($active_page, $link)
    {
        if ($active_page == $link) {
            echo "active";
        }
    }
    ?>

    <header class="sticky-top px-1">

        <!-- Nativement, avec la classe 'navbar', les éléments enfants de la nav utilisent flex, par défaut -> 'justify-content: space-between'  -->

        <!-- Création de la navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid d-flex flex-column">
                <div class="container-fluid row">
                    <!-- LIENS NAVBAR -->
                    <div class="col-5 p-0 d-flex align-items-center">
                        <ul class="navbar-nav __navbarIcons justify-content-start">
                            <li class="navbar-toggler border-0 px-0" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-bars"></i></a>
                            </li>
                        </ul>
                        <div class="d-none d-lg-inline">
                            <ul class="navbar-nav ms-3 align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="m_articles.php">Articles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="m_about.php">À propos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- LOGO -->
                    <div class="col-2 text-center">
                        <a href="m_index.php" class="navbar-brand mx-auto">
                            <img src="m_icon.png" alt="logo" class="img-fluid __logoIcon">
                        </a>
                    </div>

                    <!-- ICONES -->
                    <div class="col-5 p-0">
                        <ul class="navbar-nav __navbarIcons justify-content-end align-items-center">
                            <div id="__searchbar">
                            <li class="input-group rounded">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <!--<span class="input-group-text border-0 __navIcon nav-link" id="search-addon"> A quoi sert cet élémént ? et pourquoi quand on le commente, la barre de recherche est surélevée
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>-->
                            </li>
                            </div>
                            <li class="nav-item" id="__search-trigger">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link __navIcon" href="#" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- MENU BURGER CACHÉ EN DESKTOP -->
                <div class="container-fluid row d-lg-none">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-3">
                            <li class="nav-item">
                                    <a class="nav-link" href="m_articles.php">Articles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="m_about.php">À propos</a>
                                </li>
                            <li class="input-group rounded nav-item d-lg-none">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
                                <span class="d-flex align-items-center border-0 nav-item" id="search-addon">
                                    <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </nav>

    </header>
