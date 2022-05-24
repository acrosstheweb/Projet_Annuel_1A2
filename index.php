<?php
    $title = "Fitness Essential";
    $content = "La page d'acceuil de Fitness Essential";
    $currentPage = 'index';
    require 'header_v2.php';
    Message('Register');
    Message('Connection');
    Message('Logout');
    Message('ConfirmRegistration');
    /*print_r(checkFields([
        "lastname" => "DERGHAL",
        "firstname" => "Wissem",
        "civility" => "M",
        "birthday" => "2003-07-06",
        "email" => "wissem.derghal@gmail.com",
        "city" => "Saint-Ours",
        "zipcode" => "73410"
    ]));*/
?>

<h1 class="aligned-title"> Bienvenue sur Fitness Essential </h1>

<div class="container-fluid">
    <div class="row __frontRow justify-content-evenly align-items-center px-md-3" style="position:relative;">
    <div class="__frontBgImage"></div>
        <img src="sources/img/musculation.jpg" alt="La musculation"  class="__frontImage col-12 col-md-6 col-lg-8">
        <div class="__frontIamge-description col-12 col-md-6 col-lg-4">
            <h2 class="aligned-title">NOTRE MÉTHODE</h2>
            <p class="text-justify text-center my-lg-5">
                <span class="d-none d-lg-block">Notre approche globale de l’entraînement, issue de la préparation physique d’athlètes, va permettre un développement réel de vos capacités physiques de manière durable.<br><br></span>
                Nos entraîneurs vous accompagnent sur le meilleur assortiment sportif pour vous permettre d’atteindre rapidement vos objectifs, quelque soit votre niveau.<br><br>
                <!-- Chacun de nos 7 sports a été choisi pour être efficace et complémentaire.<br><br>
                À vous de créer un programme qui vous ressemble...<br><br>  -->
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid">

    <p class="text-center">

        <h2 class="aligned-title">NOS PROCHAINES SÉANCES</h2>

        <div id="carouselMobile" class="carousel slide d-md-none" data-bs-ride="carousel">
            <div class="carousel-inner justify-content-evenly">

                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <div class="card col-9">
                            <img src="sources/img/cycling.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">CYCLING</h5>
                                <p class="card-text">
                                    Lundi 11 juillet<br>
                                    10H00 - 60 minutes
                                </p>
                                <a href="#" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="card col-9">
                            <img src="sources/img/zumba.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">ZUMBA</h5>
                                <p class="card-text">
                                    Lundi 11 juillet<br>
                                    11H00 - 30 minutes
                                </p>
                                <a href="#" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item justify-content-evenly">
                    <div class="d-flex justify-content-center">
                        <div class="card col-9">
                            <img src="sources/img/abs.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">ABDOS - FESSIERS</h5>
                                <p class="card-text">
                                    Lundi 11 juillet<br>
                                    11H30 - 30 minutes
                                </p>
                                <a href="#" class="btn btn-primary">Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item justify-content-evenly">
                    <div class="d-flex justify-content-center">
                        <div class="card col-9">
                            <img src="sources/img/yoga.jpg" class="card-img-top" alt="...">
                            <div class="card-body text-center">
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

                <div class="carousel-item active">
                    <div class="row d-flex justify-content-center">
                        <div class="card __cardTablet col-9">
                            <img src="sources/img/cycling.jpg" class="card-img __classImage" alt="...">
                            <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                <div class="__cardDescription">
                                    <div class="__cardDescriptionText">
                                        <h5 class="card-title">CYCLING</h5>
                                        <p class="card-text">
                                            Lundi 11 juillet<br>
                                            10H00 - 60 minutes
                                        </p>
                                        <a href="#" class="btn btn-primary">Réserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row d-flex justify-content-center">
                        <div class="card __cardTablet col-9">
                            <img src="sources/img/ZUMBA.jpg" class="card-img __classImage" alt="...">
                            <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                <div class="__cardDescription">
                                    <div class="__cardDescriptionText">
                                        <h5 class="card-title">ZUMBA</h5>
                                        <p class="card-text">
                                            Lundi 11 juillet<br>
                                            11H00 - 30 minutes
                                        </p>
                                        <a href="#" class="btn btn-primary">Réserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row d-flex justify-content-center">
                        <div class="card __cardTablet col-9">
                            <img src="sources/img/abs.jpg" class="card-img __classImage" alt="...">
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
                </div>

                <div class="carousel-item">
                    <div class="row d-flex justify-content-center">
                        <div class="card __cardTablet col-9">
                            <img src="sources/img/yoga.jpg" class="card-img __classImage" alt="...">
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

                <div class="carousel-item active">
                    <div class="row d-flex justify-content-center">

                        <div class="card __cardDesktop col-4">
                            <img src="sources/img/cycling.jpg" class="card-img __classImage" alt="...">
                            <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                <div class="__cardDescription">
                                    <div class="__cardDescriptionText">
                                        <h5 class="card-title">CYCLING</h5>
                                        <p class="card-text">
                                        Lundi 11 juillet<br>
                                        10H00 - 60 minutes
                                        </p>
                                        <a href="#" class="btn btn-primary">Réserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card __cardDesktop col-4">
                            <img src="sources/img/zumba.jpg" class="card-img __classImage" alt="...">
                            <div class="card-img-overlay d-flex align-items-end justify-content-center text-center">
                                <div class="__cardDescription">
                                    <div class="__cardDescriptionText">
                                        <h5 class="card-title">ZUMBA</h5>
                                        <p class="card-text">
                                            Lundi 11 juillet<br>
                                            11H00 - 30 minutes
                                        </p>
                                        <a href="#" class="btn btn-primary">Réserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row d-flex justify-content-center">

                        <div class="card __cardDesktop col-4">
                            <img src="sources/img/abs.jpg" class="card-img __classImage" alt="...">
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

                        <div class="card __cardDesktop col-4">
                            <img src="sources/img/yoga.jpg" class="card-img __classImage" alt="...">
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


<div class="container">
    <h2 class="aligned-title">Jaaj 2</h2>
    <p class="text-center">

        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum expedita, quo nesciunt, quas ipsum optio, excepturi fugit voluptate quasi odio consequatur nihil dolorum nisi? Fugit sint in non sit reiciendis.
        Tempore beatae nemo aut, dolorum illum nulla alias commodi magni assumenda delectus fugiat quis rem architecto nobis sapiente ullam, voluptatem quod quia temporibus. Optio aperiam enim pariatur, iure deleniti nemo?
        Perspiciatis exercitationem dolor nobis. Officia provident ratione sapiente. Corrupti est modi dolorum alias minima temporibus minus pariatur velit voluptates quos, placeat labore tempore ducimus ad! Aliquid, asperiores? Omnis, molestias minima!

        <br><br><br>

        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque ea voluptate veritatis nostrum veniam natus recusandae ullam aliquam, consequuntur quisquam vero tenetur quibusdam, voluptatem deleniti in facilis rem dolore illum.
        Modi animi quo ab tempore eius veritatis maxime non recusandae explicabo, fuga beatae minima quaerat ratione! Labore autem quae, nisi quidem minus magni, illum totam corporis iure architecto laborum praesentium!
        Earum dolorem quae voluptate fuga ipsa temporibus ad vitae cumque aut eligendi aliquam molestias, corporis sed, impedit dicta fugit ex culpa dolore similique error perferendis. Molestias sit placeat sint tenetur?
        Error quidem earum laboriosam, unde ut dolore impedit vitae voluptate, mollitia nemo sit dolorum asperiores? Quam est alias laboriosam, suscipit cumque tempore quisquam architecto accusamus ipsa impedit eos voluptatibus quas.

        <br><br><br><br><br>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A voluptatibus, quaerat, natus illo eaque temporibus voluptatem sapiente ipsum cum architecto error odio magni. Iste rem magnam modi ut velit earum.
        Molestiae maiores doloribus reiciendis nam maxime nobis! Repellendus, voluptate quisquam. Ipsam neque reprehenderit, rem, veniam quisquam corrupti voluptatum optio omnis iure perspiciatis, nulla corporis dicta? Maxime atque unde vero sapiente!
        Deserunt cumque nulla, beatae fugiat rem provident tempore ea iure minima possimus aliquam, aliquid vero. Magni asperiores culpa mollitia velit, modi dolor et repellat neque, quis ex at laudantium nulla.
        Repellendus aliquam libero praesentium perspiciatis, ratione non cupiditate. Aliquid voluptate temporibus id consequuntur omnis eligendi molestias praesentium quas, nemo nisi neque ad quasi quaerat autem architecto enim. Deleniti, repellat cumque.
        Doloremque, optio ipsum. Architecto eos sed nam facere voluptas debitis. Amet dicta consequatur obcaecati aut, ullam ea explicabo voluptatum tenetur dignissimos provident blanditiis cum ducimus fuga dolores odit esse accusamus.
        Quisquam id vitae repudiandae est voluptas qui soluta magni animi numquam ut iure possimus corporis aliquid quibusdam quae quis voluptates delectus necessitatibus incidunt perspiciatis, amet minus. Eligendi dicta quisquam nemo!
        Reprehenderit consectetur hic numquam perferendis laboriosam commodi libero voluptatem asperiores aliquid, tenetur earum, nesciunt architecto officia recusandae consequuntur, ipsa dicta blanditiis fuga dolor sit provident. Porro delectus sapiente inventore quasi?
        Facere voluptatibus ullam reprehenderit voluptatum voluptatem temporibus! Deleniti eius eos, numquam nam incidunt laboriosam ea dolorem, quos alias voluptatibus et perspiciatis voluptate dolor laborum. Sapiente dicta tempora in cum porro!

    </p>
</div>

<?php
    include 'footer.php';
?>