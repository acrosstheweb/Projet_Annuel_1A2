<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Préférences newsletter";
    $content = "Préférences newsletter";
    $currentPage = 'newsletter';
    require '../../../header.php';
    Message('newsletter');
    $db = database();
    $getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email, civility, avatar, address, city, zipCode, birthday, registrationDate FROM RkU_USER WHERE id=:id");
    $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
    $user = $getUserInfoQuery->fetch();

    $getNewsletterStatusQuery = $db->prepare("SELECT newsletter FROM RkU_USER WHERE id=:id");
    $getNewsletterStatusQuery->execute(['id'=>$_SESSION['userId']]);
    $newsletterStatus = $getNewsletterStatusQuery->fetch();
?>

<h2 class="aligned-title my-3"> Mes préférences newsletter </h2>
<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include 'profilePageNavbar.php'; ?>
        </div>
        
        <div class="col-12 col-md-8 mt-3">
            <div class="row">
                Votre statut d'abonnement à la newsletter est le suivant:
                <form id="__updateNewsletterForm" action="../scripts/updateNewsletter.php?id=<?= $_SESSION['userId'] ?>" method="POST" class="col-10 col-md-8 col-lg-10 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="newsletterRadio" id="__newsletterRadioOn" <?php echo ($newsletterStatus['newsletter'] == 1) ? 'checked' : '' ?> value="1">
                        <label class="form-check-label" for="__newsletterRadioOn">
                            Abonné
                            <div class="text-secondary">
                                Vous avez décidé de recevoir des mails relous tous les mois. Je sais pas ce qui vous est passé par la tête.
                            </div>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="newsletterRadio" id="__newsletterRadioOff" <?php echo ($newsletterStatus['newsletter'] == 2) ? 'checked' : '' ?> value="2">
                        <label class="form-check-label" for="__newsletterRadioOff">
                            Désabonné
                            <div class="text-secondary">
                                Arrêter de recevoir des mails relous tous les mois.
                            </div>
                        </label>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="text-end my-4">
                    <button type="submit" form="__updateNewsletterForm" class="btn btn-primary">Enregistrer mes préférences</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include '../../../footer.php';
?>