<?php
    $title = "Fitness Essential";
    $content = "La page d'acceuil de Fitness Essential";
    $currentPage = 'index';
    require 'header.php';
    Message('Register');
    Message('Connection');
    Message('Logout');
    Message('ConfirmRegistration');
    Message('DeleteUser');
    Message('updateMail');
    Message('updatePassword');
    Message('newPassword');
    Message('newsletter');

    $pdo = database();

    $reqEvent = $pdo->query('SELECT * FROM RkU_BOOKING WHERE startDate >= Now() LIMIT 4');
    $events = $reqEvent->fetchAll();


?>

<h1 class="aligned-title"> Bienvenue sur Fitness Essential </h1>

<div class="container-fluid mb-5">

    <p class="text-center">

        <h2 class="aligned-title">NOS PROCHAINES SÉANCES</h2>

        <div id="carouselMobile" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner justify-content-evenly">

            <?php 
            $count = 0;
            foreach($events as $event){ 
                $reqSportImage = $pdo->prepare('SELECT path FROM RkU_SPORT WHERE id=:id');
                $reqSportImage->execute([
                    'id'=>$event['sport']
                ]);
                $sportImage = $reqSportImage->fetch()['path'];
            ?>
                <div class="carousel-item <?php if($count == 0){ echo 'active'; } ?>">
                    <div class="d-flex justify-content-center">
                        <div class="col-9">
                            <div class="card">
                                <img src="<?= DOMAIN . 'sources/img/' . $sportImage?>" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $event['name'] ?></h5>
                                    <p class="card-text">
                                        <?= (new Datetime($event['startDate']))->format('d/m/Y') ?><br>
                                        <?= (new Datetime($event['startDate']))->format('H:i') ?> - <?= (strtotime((new Datetime($event['endDate']))->format('H:i')) - strtotime((new Datetime($event['startDate']))->format('H:i')))/60 ?> minutes
                                    </p>
                                    <a href="#" class="btn btn-primary">Réserver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $count++; } ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobile" data-bs-slide="prev">
            <i class="fa-solid fa-angle-left __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMobile" data-bs-slide="next">
            <i class="fa-solid fa-angle-right __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="carouselTablet" class="carousel slide d-none d-md-block d-lg-none" data-bs-ride="carousel">
            <div class="carousel-inner">

            <?php 
            $count = 0;
            foreach($events as $event){ 
                $reqSportImage = $pdo->prepare('SELECT path FROM RkU_SPORT WHERE id=:id');
                $reqSportImage->execute([
                    'id'=>$event['sport']
                ]);
                $sportImage = $reqSportImage->fetch()['path'];
            ?>
                <div class="carousel-item <?php if($count == 0){ echo 'active'; } ?>">
                    <div class="d-flex justify-content-center">
                        <div class="col-9">
                            <div class="card __cardTablet">
                                <img src="<?= DOMAIN . 'sources/img/' . $sportImage?>" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $event['name'] ?></h5>
                                    <p class="card-text">
                                        <?= (new Datetime($event['startDate']))->format('d/m/Y') ?><br>
                                        <?= (new Datetime($event['startDate']))->format('H:i') ?> - <?= (strtotime((new Datetime($event['endDate']))->format('H:i')) - strtotime((new Datetime($event['startDate']))->format('H:i')))/60 ?> minutes
                                    </p>
                                    <a href="#" class="btn btn-primary">Réserver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $count++; } ?>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTablet" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTablet" data-bs-slide="next">
                <i class="fa-solid fa-angle-right __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="carouselDesktop" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
            <div class="carousel-inner">

            <?php 
            $count = 0;
            foreach($events as $event){ 
                $reqSportImage = $pdo->prepare('SELECT path FROM RkU_SPORT WHERE id=:id');
                $reqSportImage->execute([
                    'id'=>$event['sport']
                ]);
                $sportImage = $reqSportImage->fetch()['path'];
                if ($count % 2 == 0){
            ?>
                <div class="carousel-item <?php if($count == 0){ echo 'active'; } ?>">
                    <div class="row d-flex justify-content-center">
            <?php } ?>
                        <div class="col-4">
                            <div class="card __cardDesktop">
                                <img src="<?= DOMAIN . 'sources/img/' . $sportImage?>" class="card-img-top" alt="...">
                                <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                    <div class="__cardDescription">
                                        <div class="__cardDescriptionText">
                                            <h5 class="card-title"><?= $event['name'] ?></h5>
                                            <p class="card-text">
                                                <?= (new Datetime($event['startDate']))->format('d/m/Y') ?><br>
                                                <?= (new Datetime($event['startDate']))->format('H:i') ?> - <?= (strtotime((new Datetime($event['endDate']))->format('H:i')) - strtotime((new Datetime($event['startDate']))->format('H:i')))/60 ?> minutes
                                            </p>
                                            <a href="#" class="btn btn-primary">Réserver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php if ($count % 2 == 1){ ?>
                    </div>
                </div>
            <?php 
                }
                $count++; 
                } 
            ?>

                <div class="carousel-item">
                    <div class="row d-flex justify-content-center">

                        <div class="col-4">
                            <div class="card __cardDesktop">
                                <img src="<?= DOMAIN . 'sources/img/abs.jpg'?>" class="card-img __classImage" alt="...">
                                <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                    <div class="__cardDescription">
                                        <div class="__cardDescriptionText">
                                            <h5 class="card-title">ABDOS-FESSIERS</h5>
                                            <p class="card-text">
                                                Lundi 11 juillet<br>
                                                11H30 - 30 minutes
                                            </p>
                                            <a href="#" class="btn btn-primary">Réserver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card __cardDesktop">
                                <img src="<?= DOMAIN . 'sources/img/yoga.jpg'?>" class="card-img __classImage" alt="...">
                                <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                    <div class="__cardDescription">
                                        <div class="__cardDescriptionText">
                                            <h5 class="card-title">YOGA</h5>
                                            <p class="card-text">
                                                Lundi 11 juillet<br>
                                                12H00 - 60 minutes
                                            </p>
                                            <a href="#" class="btn btn-primary">Réserver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDesktop" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselDesktop" data-bs-slide="next">
                <i class="fa-solid fa-angle-right __carouselControl fa-xl" aria-hidden="true"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </p>



</div>

<div class="container-fluid">
    <div class="row __frontRow justify-content-evenly align-items-center px-md-3 mt-5">
        <div class="col-12 col-md-6 col-lg-7">
            <img src="<?= DOMAIN . 'sources/img/musculation.jpg'?>" alt="La musculation"  class="img-fluid">
        </div>
        <div class="__frontIamge-description col-12 col-md-6 col-lg-4">
            <h2 class="aligned-title">NOTRE MÉTHODE</h2>
            <p class="text-justify text-center my-lg-5">
                <span class="d-none d-lg-block">Notre approche globale de l’entraînement, issue de la préparation physique d’athlètes, va permettre un développement réel de vos capacités physiques de manière durable.<br><br></span>
                Nos entraîneurs vous accompagnent sur le meilleur assortiment sportif pour vous permettre d’atteindre rapidement vos objectifs, quelque soit votre niveau.<br><br>
                <!-- Chacun de nos 7 sports a été choisi pour être efficace et complémentaire.<br><br>
                À vous de créer un programme qui vous ressemble...<br><br>  -->
                <a href="https://shorturl.at/bglJ4" class="btn btn-primary">En savoir plus</a>
            </p>
        </div>
    </div>
</div>


<div class="container">
    <h2 class="mt-5 aligned-title text-uppercase">Jaaj</h2>
    <p class="text-center">

        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum expedita, quo nesciunt, quas ipsum optio, excepturi fugit voluptate quasi odio consequatur nihil dolorum nisi? Fugit sint in non sit reiciendis.
        Tempore beatae nemo aut, dolorum illum nulla alias commodi magni assumenda delectus fugiat quis rem architecto nobis sapiente ullam, voluptatem quod quia temporibus. Optio aperiam enim pariatur, iure deleniti nemo?
        Perspiciatis exercitationem dolor nobis. Officia provident ratione sapiente. Corrupti est modi dolorum alias minima temporibus minus pariatur velit voluptates quos, placeat labore tempore ducimus ad! Aliquid, asperiores? Omnis, molestias minima!

        <br><br><br>

        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque ea voluptate veritatis nostrum veniam natus recusandae ullam aliquam, consequuntur quisquam vero tenetur quibusdam, voluptatem deleniti in facilis rem dolore illum.
        Modi animi quo ab tempore eius veritatis maxime non recusandae explicabo, fuga beatae minima quaerat ratione! Labore autem quae, nisi quidem minus magni, illum totam corporis iure architecto laborum praesentium!
        Earum dolorem quae voluptate fuga ipsa temporibus ad vitae cumque aut eligendi aliquam molestias, corporis sed, impedit dicta fugit ex culpa dolore similique error perferendis. Molestias sit placeat sint tenetur?
        Error quidem earum laboriosam, unde ut dolore impedit vitae voluptate, mollitia nemo sit dolorum asperiores? Quam est alias laboriosam, suscipit cumque tempore quisquam architecto accusamus ipsa impedit eos voluptatibus quas.

    </p>
</div>

<?php
    include 'footer.php';
?>