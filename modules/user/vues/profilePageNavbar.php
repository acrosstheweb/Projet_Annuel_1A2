<nav class="nav flex-column px-2 py-md-3">
    <ul class="__listeVerticale">
        
        <li class="nav-item ms-md-3 mt-3">
            <span class="text-uppercase">Mon compte</span>
            <ul class="__listeVerticale">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= DOMAIN . 'modules/user/vues/profilePage.php' ?>">Mon Profil</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= DOMAIN . 'modules/user/vues/profilePageSecurity.php' ?>">Sécurité</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item ms-md-3 mt-3">
            <span class="text-uppercase">Mes préférences</span>
            <ul class="__listeVerticale">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= DOMAIN . 'modules/user/vues/profilePageNewsletter.php' ?>">Newsletter</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item ms-md-3 mt-3">
            <span class="text-uppercase">Mon activité</span>
            <ul class="__listeVerticale">
                <li class="nav-item">
                    <a class="nav-link" href="<?= DOMAIN . 'modules/user/vues/nextBookings.php'?>">Mes prochaines séances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= DOMAIN . 'modules/user/vues/pastBookings.php'?>">Historique de mes séances</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>