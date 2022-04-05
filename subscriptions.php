<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Renseignements sur les différents tarifs et détails des abonnements proposés par Fitness Essential">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Abonnements</title>
</head>
<body>

    <?php
        $currentPage = 'subscriptions';
        include 'header.php';
    ?>

    <h2 class="aligned-title"> Abonnements de Fitness Essential </h2>

    <div class="row justify-content-center">
        <div class="card" style="width: 18rem;background-color:rgb(80, 80, 80);border: 2px solid rgb(141, 233, 122);margin:50px 50px;">
            <h4 class="aligned-title">Essential</h4>
            <div class="card-body">
                <h5 class="card-title">15,99€/mois</h5>
                <p class="card-text">C'est la même qualité, c'est juste le prix qui baisse. T'es pas obligé de faire le rat par contre.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Etudiant</li>
                <li class="list-group-item">+ Bénefice</li>
                <li class="list-group-item">- Investissement</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Achète ici</a>
                <a href="#" class="card-link">Ici aussi en fait</a>
            </div>
        </div>

        <div class="card" style="width: 18rem;background-color:rgb(80, 80, 80);border: 2px solid rgb(141, 233, 122);margin:50px 50px;">
            <h4 class="aligned-title">Classic</h4>
            <div class="card-body">
                <h5 class="card-title">23,99€/Mois</h5>
                <p class="card-text">Accès classique à la salle de sport. Catégorie socioprofessionnelle moyenne, tu ne mérites pas que je t'embête</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Fonctionnaire</li>
                <li class="list-group-item">Abonnement rentabilisé</li>
                <li class="list-group-item">+ Regard des autres</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Achète ici</a>
                <a href="#" class="card-link">Ici aussi en fait</a>
            </div>
        </div>

        <div class="card" style="width: 18rem;background-color:rgb(80, 80, 80);border: 2px solid rgb(141, 233, 122);margin:50px 50px;">
            <h4 class="aligned-title">Premium</h4>
            <div class="card-body">
                <h5 class="card-title">49,99€/Mois</h5>
                <p class="card-text">Wow, tu possèdes un maximum de valeur financière, ce qui te permet donc de profiter sur système capitaliste comme bon te semble.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Pesos Mexicanos</li>
                <li class="list-group-item">Livres Sterling</li>
                <li class="list-group-item">Dinar Algérien</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Achète ici</a>
                <a href="#" class="card-link">Ici aussi en fait</a>
            </div>
        </div>
    </div>

</body>
</html>