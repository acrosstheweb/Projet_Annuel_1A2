<?php
    require 'm_header.php';
?>

<h1 class="text-center"> Bienvenue sur Culture Astronomique </h1>

<div class="container-fluid">

    <section>
        <div class="row justify-content-evenly align-items-center px-md-3 mt-5">
            <div class="col-12 col-md-10">
                <h2 class="text-center">Les articles à la une</h2>
            </div>
        </div>

        <div class="row justify-content-evenly px-md-3 my-3">

            <div class="card" style="width: 20rem;">
                <img src="m_etoile.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title __cardTitleIndex">Le cycle de vie des étoiles</h3>
                    <p class="card-text __cardTextIndex">Durant toute la durée de son existence, l’étoile traverse plusieurs stades différents mais alors, quel est le cycle de vie des étoiles ?</p>
                    <a href="m_article1.php" class="btn btn-primary stretched-link">Lire l'article</a>
                </div>
            </div>

            <div class="card" style="width: 20rem;">
                <img src="m_halley.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title __cardTitleIndex">La comète de Halley</h3>
                    <p class="card-text __cardTextIndex">Edmond Halley, célèbre astronome, a prédit le retour d’une comète dans le ciel nocturne de la Terre pour 1758, cette comète porte depuis son nom : la comète de Halley.</p>
                    <a href="m_article2.php" class="btn btn-primary stretched-link">Lire l'article</a>
                </div>
            </div>

            <div class="card" style="width: 20rem;">
                <img src="m_betelgeuse.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title __cardTitleIndex">L'avenir de Bételgeuse</h3>
                    <p class="card-text __cardTextIndex">Bételgeuse est une étoile supergéante rouge sur son lit de mort dans la constellation d'Orion. Supernova ou pas, telle est la question.</p>
                    <a href="m_article3.php" class="btn btn-primary stretched-link">Lire l'article</a>
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="row justify-content-evenly align-items-center px-md-3 mt-5">
            <div class="col-12 col-md-10">
                <h2 class="text-center">Qui sommes-nous?</h2>
            </div>
        </div>

        <div class="row justify-content-evenly px-md-3 my-3 text-center">
            <div class="col-8">
                <img src="m_banner.png" class="img-fluid mb-3" alt="banner">
                <p>
                    Nous sommes deux étudiants passionnés d’astronomie, à la recherche des histoires et des anecdotes les plus croustillantes de l’Histoire de l’astronomie ! <br><br>
                    Fidèles depuis plusieurs années au magazine Ciel&Espace et aux évènements d’observation partout en France, nous suivons également de très près le parcours de Thomas Pesquet (notre fierté nationale !).
                    De l'entraînement des astronautes, aux descriptifs d’étoiles, en passant par le démantèlement de théories du complot (non non la terre n’est pas plate haha),
                    vous pourrez bien sûr suivre les dernières actualités spatiales ainsi que nos articles sur divers sujets, plus ou moins complexes, liés à l’espace et l’astronomie. <br><br>
                    Alors si comme nous vous êtes passionnés d’astronomie et que vous souhaitez suivre l’actualité de plus près, rejoingez-nous dans cette folle aventure et laissez-nous vous conter une nouvelle histoire…
                </p>
            </div>
        </div>
    </section>

</div>

<?php
    include 'm_footer.php';
?>