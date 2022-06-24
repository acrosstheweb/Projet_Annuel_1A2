<?php

require '../../../../functions.php';

if (!isAdmin()) {
    header('Location: ../../../../error404.php');
    die();
}

if(
    empty($_POST['titre-mail']) ||
    empty($_POST['destination']) ||
    empty($_FILES['content-mail'])
){
    setMessage('FormNewsletter', ['Erreur envoi formulaire'], 'danger');
    header('Location: ../../vues/admin/newsletter.php');
}

$mailFileName = $_FILES['content-mail']['name'];
$mailFileType = $_FILES['content-mail']['type'];
$mailFileSize = $_FILES['content-mail']['size'];
$mailFileTmpName = $_FILES['content-mail']['tmp_name'];
$mailFileError = $_FILES['content-mail']['error'];

$title = ucwords(htmlspecialchars($_POST['titre-mail']));
$destination = $_POST['destination'];

$authorizedDestinations = ['everyone','customers','coachs','owners','admins'];
if(!in_array($destination, $authorizedDestinations)){
    setMessage('FormNewsletter', ['Vous devez choisir un bouton radio dans la liste'], 'danger');
    header('Location: ../../vues/admin/newsletter.php');
    die();
}

$extensionsAllowed = ['html', 'htm'];
$name_extension = explode('.', $mailFileName);
$extension = strtolower($name_extension[1]);

if(count($name_extension) == 2 && in_array( $extension , $extensionsAllowed)){
    if($mailFileType == "text/html"){
        if($mailFileSize <= 5000000){ // 5000000 Bytes = 5Mo
            $tmpId = uniqid();
            move_uploaded_file($mailFileTmpName, ABSOLUTE_PATH . '/tmpUpload/mail'.$tmpId.'.'.$extension); // On déplace le fichier dans le dossier tmpUpload
        }else{
            setMessage('FormNewsletter', ['Type de fichier interdit, vous devez utiliser un fichier html'], 'warning');
            header('Location: ../../vues/admin/newsletter.php');
            die();
        }
    }else{
        setMessage('FormNewsletter', ['Type de fichier interdit, vous devez utiliser un fichier html'], 'warning');
        header('Location: ../../vues/admin/newsletter.php');
        die();
    }
}else{
    setMessage('FormNewsletter', ['Extension Incorrecte, Le fichier téléversé doit être sous forme x.html ou x.html'], 'warning');
    header('Location: ../../vues/admin/newsletter.php');
    die();
}

$db = database();

switch ($destination){
    case 'everyone':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE (role >= 1 AND newsletter = 1)");
        break;
    case 'customers':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE (role = 1 AND newsletter = 1)");
        break;
    case 'coachs':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE (role = 2 AND newsletter = 1)");
        break;
    case 'owners':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE (role = 3 AND newsletter = 1)");
        break;
    case 'admins':
        $destinationsQuery = $db->query("SELECT email FROM RkU_USER WHERE (role >= 4 AND newsletter = 1)");
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

$headers = "From: \"Fitness Essential\" fitness3ssential@gmail.com" . PHP_EOL;
$headers .= "Bcc: $destinations" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";

$content = file_get_contents(ABSOLUTE_PATH . '/tmpUpload/mail'.$tmpId.'.'.$extension);

if(mail(null, $title, $content, $headers)) {

    setMessage('FormNewsletter', ["Newsletter envoyée"],'success');
}else{
    $lastError = (string)error_get_last()['message'];
    setMessage('FormNewsletter', ["Echec de l'envoi du mail newsletter", error_get_last()['message']], 'warning'); // error_get_last()['message'] affiche la dernière erreur rencontrée dans le cas où le mail n'est pas envoyé, c'est la raison de l'échec qui sera affichée; TODO potentiellment le retirer en PROD
    /*dd(error_get_last()['message']);*/
}
header('Location: ../../vues/admin/newsletter.php');
die();