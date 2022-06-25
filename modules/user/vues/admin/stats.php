<?php
require '../../../../functions.php';

if(!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

require '../../../../header.php';
$db = database();
$ages = []; $subscriptions = []; $civilities = [];
$numberOfUsersQ = $db->query("SELECT COUNT(*) FROM RkU_USER WHERE role > 0");
$userPerAgeQ = $db->query("SELECT birthday FROM RkU_USER WHERE role > 0"); // On ne prend en compte que les comptes confirmés
$userPerSubQ = $db->query("SELECT subscription FROM RkU_USER WHERE role > 0");
$newsletterSubsQ = $db->query("SELECT COUNT(*) FROM RkU_USER WHERE newsletter = 1 AND ROLE > 0");
$userPerCivilityQ = $db->query("SELECT civility FROM RkU_USER WHERE role > 0");
$newsletterSubs = $newsletterSubsQ->fetch()[0];
$numberOfUsers = $numberOfUsersQ->fetch()[0];
$newsletterNotSubs = $numberOfUsers - $newsletterSubs;

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

    <h1 class="aligned-title">Statistiques générales</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none col-2 d-md-flex justify-content-center">
                <?php include "adminNavbar.php"; ?>
            </div>

            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <h5>Nombre d'utilisateurs par année de naissance</h5>
                        <div class="row">
                            <h6>18 - 24 Ans</h6>
                            <div clas="col-2" id="18-24">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>25 - 34 Ans</h6>
                            <div clas="col-2" id="25-34">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>35 - 44 Ans</h6>
                            <div clas="col-2" id="35-44">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>45 - 54 Ans</h6>
                            <div clas="col-2" id="45-54">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>+ 55 Ans</h6>
                            <div clas="col-2" id="55">
                                <div class="__rectangleStat"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-6">
                        <h5>Nombre d'abonnés par types d'abonnements</h5>
                        <div class="row">
                            <h6>ESSENTIAL</h6>
                            <div clas="col-2" id="__essential">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>CLASSIC</h6>
                            <div clas="col-2" id="__classic">
                                <div class="__rectangleStat"></div>
                            </div>

                            <h6>PREMIUM</h6>
                            <div clas="col-2" id="__premium">
                                <div class="__rectangleStat"></div>
                            </div
                        </div>
                    </div>
                </div>

                <div class="row mt-5"><hr>
                    <div class="col-4">
                        <h5>Nombre d'abonnés à la newsletter</h5>
                        <h6>Abonnés</h6>
                        <div clas="col-2">
                            <div class="__rectangleStat" id="__newsletterSub"></div>
                        </div>

                        <h6>Non Abonnés</h6>
                        <div clas="col-2">
                            <div class="__rectangleStat" id="__newsletterNotSub"></div>
                        </div>
                    </div>

                    <div class="col-4">
                        <h5>Utilisateurs par civilité</h5>
                        <h6>M</h6>
                        <div clas="col-2">
                            <div class="__rectangleStat" id="__M"></div>
                        </div>

                        <h6>F</h6>
                        <div clas="col-2">
                            <div class="__rectangleStat" id="__F"></div>
                        </div>
                    </div>

                    <div class="col-4">
                        <h5>Utilisateurs par Régions</h5>
                        COMING SOON
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
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
                    let width = a/ages.length;
                    let div = document.getElementById('18-24');
                    div.lastElementChild.style.cssText = `
                    border: 2px solid black;
                    background-color:green;
                    width:`+50*width+`%;`;
                    div.children[0].innerHTML = a;
                }else if(age >= 25 && age < 35){
                    b++;
                    let width = b/ages.length;
                    let div = document.getElementById('25-34');
                    div.lastElementChild.style.cssText = `
                    border: 2px solid black;
                    background-color:darkcyan;
                    width:`+50*width+`%;`;
                    div.children[0].innerHTML = b;
                }else if(age >= 35 && age < 45) {
                    c++;
                    let width = c/ages.length;
                    let div = document.getElementById('35-44');
                    div.lastElementChild.style.cssText = `
                    border: 2px solid black;
                    background-color:chocolate;
                    width:`+50*width+`%;`;
                    div.children[0].innerHTML = c;
                }else if(age >= 45 && age < 55){
                    d++;
                    let width = d/ages.length;
                    let div = document.getElementById('45-54');
                    div.lastElementChild.style.cssText = `
                    border: 2px solid black;
                    background-color:darkorange;
                    width:`+50*width+`%;`;
                    div.children[0].innerHTML = d;
                }else if(age >= 55){
                    e++;
                    let width = e/ages.length;
                    let div = document.getElementById('55');
                    div.lastElementChild.style.cssText = `
                    border: 2px solid black;
                    background-color:grey;
                    width:`+50*width+`%;`;
                    div.lastElementChild.innerHTML = e;
                }
            }
        }

        let subscriptions = <?php echo json_encode($subscriptions, JSON_NUMERIC_CHECK); ?>;
        if (subscriptions != null){
            let essential = 0;
            let classic = 0;
            let premium = 0;
            for (let subs of subscriptions){
                if(subs == 1){
                    essential++;
                    let width = essential/subscriptions.length;
                    let div = document.getElementById('__essential');
                    div.lastElementChild.style.cssText = `
                    border:2px solid black;
                    background-color:green;
                    width:`+50*width+`%;`;
                    div.lastElementChild.innerHTML = essential;
                }else if(subs == 2){
                    classic++;
                    let width = classic/subscriptions.length;
                    let div = document.getElementById('__classic');
                    div.lastElementChild.style.cssText = `
                    border:2px solid black;
                    background-color:darkcyan;
                    width:`+50*width+`%;`;
                    div.lastElementChild.innerHTML = classic;
                }else if(subs == 3){
                    premium++;
                    let width = premium/subscriptions.length;
                    let div = document.getElementById('__premium');
                    div.lastElementChild.style.cssText = `
                    border:2px solid black;
                    background-color:gold;
                    width:`+50*width+`%;`;
                    div.lastElementChild.innerHTML = premium;
                }
            }
        }


        let newsletter = <?php echo json_encode($newsletterSubs, JSON_NUMERIC_CHECK); ?>;
        let users = <?php echo json_encode($numberOfUsers, JSON_NUMERIC_CHECK); ?>;
        if(newsletter != null && users != null){
            // Abonnés Newsletter
            let width = newsletter/users;
            let div = document.getElementById("__newsletterSub");
            div.style.cssText = `
            background-color:darkcyan;
            border: 2px solid black;
            width:`+100*width+`%;`;
            div.innerHTML = newsletter;
            // Non abonnés
            width = (users - newsletter)/users;
            div = document.getElementById("__newsletterNotSub");
            div.style.cssText = `
            background-color:grey;
            border: 2px solid black;
            width:`+100*width+`%;`;
            div.innerHTML = users - newsletter;
        }

        let civilities = <?php echo json_encode($civilities, JSON_NUMERIC_CHECK); ?>;
        if (civilities != null){
            let M = 0;
            let F = 0;
            for (let civility of civilities){
                if(civility == 'M'){
                    M++;
                    let width = M/civilities.length;
                    let div = document.getElementById('__M');
                    div.style.cssText = `
                    border:2px solid black;
                    background-color:turquoise;
                    width:`+50*width+`%;`;
                    div.innerHTML = M;
                }else if(civility == 'F'){
                    F++;
                    let width = F/civilities.length;
                    let div = document.getElementById('__F');
                    div.style.cssText = `
                    border:2px solid black;
                    background-color:salmon;
                    width:`+50*width+`%;`;
                    div.innerHTML = F;
                }
            }
        }

    </script>


<?php
include "../../../../footer.php";
?>