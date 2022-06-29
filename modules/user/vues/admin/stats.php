<?php
    require '../../../../functions.php';

    if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }
    $title = "Fitness Essential - Statistiques";
    $content = "Statistiques";
    $currentPage = 'stats';

    require '../../../../header.php';
    $db = database();
    $ages = []; $subscriptions = []; $civilities = [];
    $numberOfUsersQ = $db->query("SELECT COUNT(*) FROM RkU_USER WHERE role > 0");
    $userPerAgeQ = $db->query("SELECT birthday FROM RkU_USER WHERE role > 0"); // On ne prend en compte que les comptes confirmés
    $userPerSubQ = $db->query("SELECT subscription FROM RkU_USER WHERE role > 0 AND subscription IS NOT NULL");
    $newsletterSubsQ = $db->query("SELECT COUNT(*) FROM RkU_USER WHERE newsletter = 1 AND ROLE > 0");
    $userPerCivilityQ = $db->query("SELECT civility FROM RkU_USER WHERE role > 0");
    $questionsForumQ = $db->query("SELECT COUNT(*) FROM RkU_QUESTION");
    $messagesForumQ = $db->query("SELECT COUNT(*) FROM RkU_MESSAGE");

    $newsletterSubs = $newsletterSubsQ->fetch()[0];
    $numberOfUsers = $numberOfUsersQ->fetch()[0];
    $newsletterNotSubs = $numberOfUsers - $newsletterSubs;
    $questionsForum = $questionsForumQ->fetch()[0];
    $messagesForum = $messagesForumQ->fetch()[0];

    foreach($userPerAgeQ->fetchAll() as $b) {
        $birthday = $b[0];
        $age = (time() - strtotime($birthday))/60/60/24/365.25;
        $ages[] = $age;
    }
    foreach($userPerSubQ->fetchAll() as $s) {
        $subscription = $s[0];
        $subscriptions[] = $subscription;
    }
    foreach($userPerCivilityQ->fetchAll() as $c){
        $civility = $c[0];
        $civilities[] = $civility;
    }
?>

<div class="container-fluid d-lg-none">
    <div class="row __profileDropdown">
        <div class="dropdown d-grid gap-2">
            <button class="btn dropdown-toggle text-light" type="button" id="__profileDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $content ?>
            </button>
            <ul class="dropdown-menu justify-content-center __profileDropdownMenu text-light" aria-labelledby="dropdownMenuButton1">
                <?php include 'adminNavbar.php'; ?>
            </ul>
        </div>
    </div>
</div>


    <h1 class="aligned-title">Statistiques générales</h1>
    <div class="fs-2 text-uppercase text-center my-2">
        Nombre total d'utilisateurs vérifiés: <?= $numberOfUsers ?> 
    </div>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center justify-content-lg-start">
            <div class="d-none col-2 d-lg-flex justify-content-center">
                <?php include "adminNavbar.php"; ?>
            </div>

            <div class="col-12 col-md-10 col-lg-8">
                <div class="row justify-content-evenly">
                    
                    <div class="col-12 col-md-4 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Utilisateurs par civilité</h5>
                            <div class="progress p-0 m-2">
                                <div id="__M" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__F" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__M-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Hommes
                                <span class="float-end" id="__M-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__F-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Femmes
                                <span class="float-end" id="__F-value">0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Nombre d'utilisateurs par abonnement</h5>
                            <div class="progress p-0 m-2">
                                <div id="__essential" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__classic" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__premium" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__essential-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Essential
                                <span class="float-end" id="__essential-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__classic-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Classic
                                <span class="float-end" id="__classic-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__premium-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Premium
                                <span class="float-end" id="__premium-value">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Nombre d'utilisateurs par âge</h5>
                            <div class="progress p-0 m-2">
                                <div id="__18-24" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__25-34" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__35-44" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__45-54" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__55" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__18-24-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                18 à 24 ans
                                <span class="float-end" id="__18-24-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__25-34-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                25 à 34 ans
                                <span class="float-end" id="__25-34-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__35-44-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                35 à 44 ans
                                <span class="float-end" id="__35-44-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__45-54-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                45 à 54 ans
                                <span class="float-end" id="__45-54-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__55-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Plus de 55 ans
                                <span class="float-end" id="__55-value">0</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-evenly"><hr class="mt-3">
                    <div class="col-12 col-md-6 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Abonnements à la newsletter</h5>
                            <div class="progress p-0 m-2">
                                <div id="__subscribed" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__notSubscribed" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__subscribed-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Abonnés
                                <span class="float-end" id="__subscribed-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__notSubscribed-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Non abonnés
                                <span class="float-end" id="__notSubscribed-value">0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Interactions sur le forum</h5>
                            <div class="progress p-0 m-2">
                                <div id="__questions" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                <div id="__answers" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__questions-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Questions
                                <span class="float-end" id="__questions-value">0</span>
                            </div>
                            <hr>
                            <div class="__stats-description">
                                <div class="progress p-0 m-1 float-start __stats-caption">
                                    <div id="__answers-caption" class="progress-bar __stats-caption" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                Réponses
                                <span class="float-end" id="__answers-value">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-evenly"><hr class="mt-3">
                    <div class="col-12 col-md-4 my-2">
                        <div class="card shadow __chartCard p-3">
                            <h5 class="text-center">Utilisateurs par région</h5>
                            <div class="text-center">Bientôt disponible</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        // DONNÉES ÂGE
        let ages = <?php echo json_encode($ages, JSON_NUMERIC_CHECK); ?>;
        if (ages != null){
            let a = 0; // 18 - 24
            let b = 0; // 25 - 34
            let c = 0; // 35 - 44
            let d = 0; // 45 - 54
            let e = 0; // >= 55
            for (let age of ages){
                if(age >= 18 && age < 25){
                    a++;
                    let width = (a/ages.length)*100;
                    let div = document.getElementById('__18-24');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__18-24-value').innerText = a;
                }else if(age >= 25 && age < 35){
                    b++;
                    let width = (b/ages.length)*100;
                    let div = document.getElementById('__25-34');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__25-34-value').innerText = b;
                }else if(age >= 35 && age < 45) {
                    c++;
                    let width = (c/ages.length)*100;
                    let div = document.getElementById('__35-44');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__35-44-value').innerText = c;
                }else if(age >= 45 && age < 55){
                    d++;
                    let width = (d/ages.length)*100;
                    let div = document.getElementById('__45-54');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__45-54-value').innerText = d;
                }else if(age >= 55){
                    e++;
                    let width = (e/ages.length)*100;
                    let div = document.getElementById('__55');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__55-value').innerText = e;
                }
            }
        }

        // DONNÉES ABONNEMENT
        let subscriptions = <?php echo json_encode($subscriptions, JSON_NUMERIC_CHECK); ?>;
        if (subscriptions != null){
            let essential = 0;
            let classic = 0;
            let premium = 0;
            for (let subs of subscriptions){
                if(subs == 1){
                    essential++;
                    let width = (essential/subscriptions.length)*100;
                    let div = document.getElementById('__essential');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__essential-value').innerText = essential;
                }else if(subs == 2){
                    classic++;
                    let width = (classic/subscriptions.length)*100;
                    let div = document.getElementById('__classic');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__classic-value').innerText = classic;
                }else if(subs == 3){
                    premium++;
                    let width = (premium/subscriptions.length)*100;
                    let div = document.getElementById('__premium');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__premium-value').innerText = premium;
                }
            }
        }

        // DONNÉES NEWSLETTER
        let newsletter = <?php echo json_encode($newsletterSubs, JSON_NUMERIC_CHECK); ?>;
        let users = <?php echo json_encode($numberOfUsers, JSON_NUMERIC_CHECK); ?>;
        if(newsletter != null && users != null){
            // Abonnés Newsletter
            let width = (newsletter/users)*100;
            let div = document.getElementById("__subscribed");
            div.setAttribute('aria-valuenow', width);
            div.setAttribute('style', `width: ${width}%;`);
            document.getElementById('__subscribed-value').innerText = newsletter;
            // Non abonnés
            width = ((users - newsletter)/users)*100;
            div = document.getElementById("__notSubscribed");
            div.setAttribute('aria-valuenow', width);
            div.setAttribute('style', `width: ${width}%;`);
            document.getElementById('__notSubscribed-value').innerText = users-newsletter;
        }

        let civilities = <?php echo json_encode($civilities, JSON_NUMERIC_CHECK); ?>;
        if (civilities != null){
            let M = 0;
            let F = 0;
            for (let civility of civilities){
                if(civility == 'M'){
                    M++;
                    let width = (M/civilities.length)*100;
                    let div = document.getElementById('__M');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__M-value').innerText = M;
                }else if(civility == 'F'){
                    F++;
                    let width = (F/civilities.length)*100;
                    let div = document.getElementById('__F');
                    div.setAttribute('aria-valuenow', width);
                    div.setAttribute('style', `width: ${width}%;`);
                    document.getElementById('__F-value').innerText = F;
                }
            }
        }

        let questions = <?php echo json_encode($questionsForum, JSON_NUMERIC_CHECK); ?>;
        if(questions != null){
            let div = document.getElementById('__questions');
            div.setAttribute('aria-valuenow', width);
            div.setAttribute('style', `width: ${width}%;`);
            document.getElementById('__questions-value').innerText = questions;
        }

        let reponses = <?php echo json_encode($messagesForum, JSON_NUMERIC_CHECK); ?>;
        if(reponses != null){
            let div = document.getElementById('__answers');
            div.setAttribute('aria-valuenow', width);
            div.setAttribute('style', `width: ${width}%;`);
            document.getElementById('__answers-value').innerText = reponses;
        }

    </script>


<?php
include "../../../../footer.php";
?>