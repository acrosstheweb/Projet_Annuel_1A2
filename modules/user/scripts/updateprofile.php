<?php
require '../../../functions.php';
if(
    count($_POST) != 7 ||
    empty($_POST['profileCivility']) ||
    empty($_POST['profileFirstName']) ||
    empty($_POST['profileLastName']) ||
    empty($_POST['profileBirthDate']) ||
    empty($_POST['profileAddress']) ||
    empty($_POST['profileZipCode']) ||
    empty($_POST['profileCity'])
){
    setMessage('UpdateHack', ['Non respect des règles du formulaire de modification du profil'],'danger');
    header('Location: ../../../error404.php');
    die();
}
$id = $_SESSION['userId'];
$civility = $_POST['profileCivility'];
$birthday = $_POST['profileBirthDate'];
$lastname = strtoupper($_POST['profileLastName']);
$firstname = ucwords(strtolower($_POST['profileFirstName']));
$address = ucwords(strtolower($_POST['profileAddress']));
$city = ucwords(strtolower($_POST['profileCity']));
$zipCode = $_POST['profileZipCode'];

$verifChamps = checkFields([
    'civility' => $civility,
    'birthday' => $birthday,
    'lastname' => $lastname,
    'firstname' => $firstname,
    'address' => $address,
    'city' => $city,
    'zipcode' => $zipCode,
], false);

/*TODO SI POST = BDD ALORS echo (AUCUNE MISE A JOUR)*/
if($verifChamps[0] === true){
    $champs = $verifChamps[1];

    $db = database();
    $insertUserQuery = $db->prepare("UPDATE RkU_USER SET 
                                            firstname = :firstname,
                                            lastname = :lastname,
                                            address = :address,
                                            city = :city,
                                            zipcode = :zipcode,
                                            civility=:civility,
                                            birthday=:birthday
                                            WHERE id=:id");

    $insertUserQuery->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address' => $address,
        'city' => $city,
        'zipcode' => $zipCode,
        'civility' => $civility,
        'birthday' => $birthday,
        'id' => $id
    ]);

    setMessage('Update', ['Mise à jour du profil réussie !'], 'success');
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('Update', $verifChamps[1], 'warning');
}
header('Location: ../vues/profilePage.php');
die();