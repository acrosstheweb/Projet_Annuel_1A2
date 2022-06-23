<?php

require '../../../../functions.php';

if (!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}



if(
    empty($_POST['titre-mail']) ||
    empty($_POST['destination']) ||
    empty($_POST['content-mail'])
){
    setMessage('FormNewsletter', ['Erreur envoi formulaire'], 'danger');
    header('Location: ../../vues/admin/newsletter.php');
}

$title = ucwords(htmlspecialchars($_POST['titre-mail']));
$destination = $_POST['destination'];
$content = htmlentities($_POST['content-mail'], ENT_QUOTES);

$authorizedDestinations = ['everyone','customers','coachs','owners','admins'];
if(!in_array($destination, $authorizedDestinations)){
    setMessage('FormNewsletter', ['Vous devez choisir un bouton radio dans la liste'], 'danger');
    header('Location: ../../vues/admin/newsletter.php');
    die();
}
$db = database();

switch ($destination){
    case 'everyone':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE role >= 1");
        break;
    case 'customers':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE role == 1");
        break;
    case 'coachs':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE role == 2");
        break;
    case 'owners':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE role == 3");
        break;
    case 'admins':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE role >= 4");
        break;
    default:
        // Comment c'est possible d'arriver ici ???
        header('Location: ../../../../error404.php');
        die();
}

foreach($destinationsQuery->fetchAll() as $d){
    $destinations[] = $d['email'];
}

$destinations = implode(',', $destinations);

$headers = 'From: "Fitness Essential" fitness3ssential@gmail.com' . PHP_EOL;
$headers .= "Bcc: $destinations" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= 'Content-type: text/html; charset=iso-8859-1';

if(mail(null, $title, $content, $headers)) {

    setMessage('FormNewsletter', ["Newsletter envoyée"],'success');
}else{
    $lastError = (string)error_get_last()['message'];
    setMessage('FormNewsletter', ["Echec de l'envoi du mail newsletter", error_get_last()['message']], 'warning'); // error_get_last()['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    /*dd(error_get_last()['message']);*/
}
header('Location: ../../vues/admin/newsletter.php');
die();