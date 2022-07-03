<?php
$title = "Fitness Essential - Écrivez-nous";
$content = "Création d'un message sur le forum";
$currentPage = 'messae';
require 'functions.php';

if(!isConnected()){
    header('Location: pleaseLogin.php');
    die();
}

if(isset($_POST['contactFormSubmit'])){
    if(
        !isset($_POST['messageSubject']) ||
        !isset($_POST['messageDescription']) ||
        !isset($_POST['contactTopic'])
    ){
        setMessage('contact', ['Erreur formulaire'], 'danger');
        header('Location: contact.php');
        die();
    }
    $userId = $_SESSION['userId'];
    $authorizedTopics = ['1', '2', '3', '4', '5'];
    $topic = $_POST['contactTopic'];
    if(!in_array($topic, $authorizedTopics)){
        setMessage('contact', ['Erreur sujet formulaire'], 'danger');
        header('Location: contact.php');
        die();
    }

    $objet = htmlspecialchars($_POST['messageSubject']);
    $description = htmlspecialchars($_POST['messageDescription']);

    $db = database();
    $userInfoQ = $db->prepare("SELECT email FROM RkU_USER WHERE id=:id");
    $userInfoQ->execute(['id'=>$userId]);
    $userInfo = $userInfoQ->fetch();

    $boundary = md5(uniqid(microtime(), TRUE));

    $subject = 'Contact : ' . $objet;
    $headers = 'From: Fitness Essential <fitness-essential@pa-atw.fr>' . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=iso-8859-1';
    $email = $userInfo["email"];

    $mailContent = '<!DOCTYPE html><html>';
    $mailContent.= '<section align="center">';
    $mailContent.=     '<h1>Demande de contact de '. $email .'</h1>';
    $mailContent.=     '<h3>Objet : '. $objet .'</h3>';
    $mailContent.=     '<p>'. $description .'</p>';
    $mailContent.= '</section>';
    $mailContent.= '</html>';

    if(mail('fitness-essential@pa-atw.fr',$subject, $mailContent, $headers)) {
        setMessage('contact', ["Formulaire de contact envoyé avec succès, votre demande sera traité dans les plus brefs délais"],'success');
    }else{
        $lastError = (string)error_get_last()['message'];
        setMessage('contact', ["Echec de l'envoi du formulaire de contact", "$lastError"], 'warning'); // error_get_last(['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    }
    header('Location: contact.php');
    die();

}
require 'header.php';
Message('contact');
?>

    <h2 class="aligned-title"> Une question? Contactez-nous </h2>

    <p class="text-center">Votre demande sera traitée dans les plus brefs délais.</p>

    <div class="row d-flex justify-content-center">
        <form action="" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
            <div class="row my-3">
                <label for="contactTopic">Sélectionnez un sujet : </label>
                <select class="form-select" name="contactTopic" id="contactTopic" required="required"><br>
                    <option value="" selected disabled hidden>Veuillez choisir</option>
                    <option value="1">Problème inscription/connexion</option>
                    <option value="2">Non réception des FitCoins</option>
                    <option value="3">Codes de réduction</option>
                    <option value="4">Bug général</option>
                    <option value="5">Autre</option>
                </select>
            </div>

            <div class="row my-3">
                <label for="messageSubject">Objet : </label>
                <input class="form-control" type="text" name="messageSubject" id="messageSubject" placeholder="Sujet" required="required"><br>
            </div>

            <div class="row my-3">
                <label for="messageDescription">Décrivez-nous votre problème : </label>
                <textarea class="form-control" name="messageDescription" id="messageDescription" placeholder="Message" rows="5" required="required"></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary" name="contactFormSubmit">Envoyer</button>
            </div>
        </form>
    </div>

<?php
include 'footer.php';
?>