<?php
    require 'm_header.php';
?>

<h1 class="text-center"> Nos articles à la une </h1>

<div class="container-fluid d-flex justify-content-center">

    <section>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mb-3 __article">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="m_etoile.jpg" class="img-fluid rounded-start __img-article" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">Le cycle de vie des étoiles</h3>
                                <p class="card-text">Durant toute la durée de son existence, l’étoile traverse plusieurs stades différents mais alors, quel est le cycle de vie des étoiles ?</p>
                                <a href="m_article1.php" class="btn btn-primary stretched-link">Lire l'article</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card mb-3 __article">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="m_halley.jpg" class="img-fluid rounded-start __img-article" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">La comète de Halley</h3>
                                <p class="card-text">Edmond Halley, célèbre astronome, a prédit le retour d’une comète dans le ciel nocturne de la Terre pour 1758, cette comète porte depuis son nom : la comète de Halley.</p>
                                <a href="m_article1.php" class="btn btn-primary stretched-link">Lire l'article</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card mb-3 __article">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="m_betelgeuse.jpg" class="img-fluid rounded-start __img-article" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">L'avenir de Bételgeuse</h3>
                                <p class="card-text">Bételgeuse est une étoile supergéante rouge sur son lit de mort dans la constellation d'Orion. Supernova ou pas, telle est la question.</p>
                                <a href="m_article1.php" class="btn btn-primary stretched-link">Lire l'article</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

</div>

<?php
    include 'm_footer.php';
?>