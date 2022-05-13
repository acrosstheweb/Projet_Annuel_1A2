<?php
require 'functions.php';
if(
    count($_POST) != 8 ||
    empty($_POST['profileCivility']) ||
    empty($_POST['profileFirstName']) ||
    empty($_POST['profileLastName']) ||
    empty($_POST['profileEmail']) ||
    empty($_POST['profileBirthDate']) ||
    empty($_POST['profileAddress']) ||
    empty($_POST['profileZipCode']) ||
    empty($_POST['profileCity'])
){
    setMessage('UpdateHack', ['Non respect des règles du formulaire de modification du profil'],'danger');
    header('Location: error404.php');
    die();
}
$id = $_SESSION['userId'];
$civility = $_POST['profileCivility'];
$birthday = $_POST['profileBirthDate'];
$lastname = strtoupper($_POST['profileLastName']);
$firstname = ucwords(strtolower($_POST['profileFirstName']));
$email = strtolower(trim($_POST['profileEmail']));
$address = ucwords(strtolower($_POST['profileAddress']));
$city = ucwords(strtolower($_POST['profileCity']));
$zipCode = $_POST['profileZipCode'];

$problems = [];
$supportedCivilities = ['M', 'F'];

if(!in_array($civility, $supportedCivilities)){
    $problems[] = 'Civilité non supportée';
}

$birthdayArray = explode('-',$birthday); // [YYYY,MM,DD]

if(!checkdate($birthdayArray[1] ,$birthdayArray[2] ,$birthdayArray[0]) || count($birthdayArray)!= 3){
    $problems[] = 'Format de la date de naissance incorrecte';
}else{ // Si le format de la date est correcte
    $ageInSeconds = time() - strtotime($birthday);
    $age = $ageInSeconds / (60/60/24/365.25); // (60/60/24/365.25) permet de convertir des secondes en années
    if($age < 18){
        $problems[] = 'Vous devez être majeur pour avoir un compte Fitness Essential';
    }
}

$exceptions = [' ','-','é','è','ê','ë','à','â','î','ï','ô','ö','û','ü']; // Tableau qui permet de laisser passer ses caractères dans les vérifications des champs (les lettres accentuées n'étant pas reconnu comme des caractères alphabétiques)

if(strlen($lastname) < 2 || strlen($lastname) > 180 || !ctype_alpha(str_replace($exceptions, '', $lastname))){
    $problems[] = 'Le nom de famille doit être entre 2 et 180 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
}

if(strlen($firstname) < 2 || strlen($firstname) > 100 || !ctype_alpha(str_replace($exceptions, '', $firstname))){
    $problems[] = 'Le prénom doit être entre 2 et 100 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $problems[] = 'Format de l\'adresse mail incorrecte';
}else{
    // Gere si l'adresse mail existe déjà
    $db = database();

    $checkUserExistQuery = $db->prepare("SELECT id FROM rku_user WHERE email=:email AND id!=:id LIMIT 1");
    $checkUserExistQuery->execute(["email"=>$email, "id"=>$id]);
    $checkUserExist = $checkUserExistQuery->fetch();

    if(!empty($checkUserExist)){
        $problems[] = "Ce mail est déjà utilisé";
    }
}

if(strlen($address) < 2 || strlen($address) > 200 || !ctype_alnum(str_replace($exceptions, '', $address))){
    $problems[] = 'L\'adresse doit comprendre entre 2 et 200 caractères alphanumériques'; // Alphnumériques + $exceptions autorisés
}

if(strlen($city) < 2 || strlen($city) > 180 || !ctype_alpha(str_replace($exceptions, '', $city))){
    $problems[] = 'La ville doit contenir entre 2 et 180 caractères alphabétiques'; // Alphabétiques + $exceptions autorisés
}

if(strlen($zipCode)!= 5 || !ctype_digit($zipCode)){
    $problems[] = 'Le code postal doit contenir exactement 5 chiffres';
}

if(count($problems) == 0){

    $insertUserQuery = $db->prepare("UPDATE RkU_user SET 
                                            firstname = :firstname,
                                            lastname = :lastname,
                                            email = :email,
                                            address = :address,
                                            city = :city,
                                            zipcode = :zipcode,
                                            civility=:civility,
                                            birthday=:birthday
                                            WHERE id=:id");

    $insertUserQuery->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'address' => $address,
        'city' => $city,
        'zipcode' => $zipCode,
        'civility' => $civility,
        'birthday' => $birthday,
        'id' => $id
    ]);
    setMessage('Update', ['Mise à jour du profil réussie !'], 'success');
    header('Location: profilePage.php');
    die();
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('Update', $problems, 'warning');
    header('Location: profilePage.php');
    die();
}