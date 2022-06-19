<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© 2022 Fitness Essential, Inc</p>

        <a href="<?= DOMAIN . 'index.php'?>" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="<?= DOMAIN . 'sources/img/icon.png'?>" alt="logo" class="img-fluid footer-logo">
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="<?= DOMAIN . 'index.php'?>" class="nav-link px-2 text-muted">Accueil</a></li>
            <li class="nav-item"><a href="<?= DOMAIN . 'contact.php'?>" class="nav-link px-2 text-muted">Contact</a></li>
            <li class="nav-item"><a href="<?= DOMAIN . 'faq.php'?>" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="<?= DOMAIN . 'rgpd.php'?>" class="nav-link px-2 text-muted">RGPD</a></li>
        </ul>
    </footer>
</div>

<?php
    if (isConnected()){
        $db = database();
        $getUserInfoQuery = $db->prepare("SELECT newsletter FROM RkU_USER WHERE id=:id");
        $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
        $newsletter = $getUserInfoQuery->fetch()['newsletter'];

        if ($newsletter == 0){
            $show = 1;
        } else {
            $show = 0;
        }
    }
    
    if (!isConnected() || $show == 1){
?>
<button type="button" id="__newsletterButton" class="btn btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#newsletterModal"><i class="fa-solid fa-envelope"></i></button>

<div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscrivez-vous à notre newsletter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="__newsletterForm" action="<?= DOMAIN . 'modules/user/scripts/updateNewsletter.php' ?>" method="POST" >
                    <div class="deleteFormInfo">
                        <h5>Découvrez les nouveautés de Fitness Essential et accédez à des évènements en avant-première</h5>
                        <div class="row">
                            <input id="__newsletterInput" class="form-control my-3" type="text" name="newsletterInput" placeholder="Adresse e-mail" required="required">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <div>
                    <button class="btn btn-danger">Ne plus afficher</button>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" form="__newsletterForm" type="submit">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>