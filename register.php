<?php

if(
    count($_POST) != 10 ||
    empty($_POST['register-gender']) ||
    empty($_POST['register-civility']) ||
    empty($_POST['register-birthday']) ||
    empty($_POST['register-lastname']) ||
    empty($_POST['register-firstname']) ||
    empty($_POST['register-email']) ||
    empty($_POST['register-address']) ||
    empty($_POST['register-city']) ||
    empty($_POST['register-zip-code']) ||
    empty($_POST['register-password']) ||
    empty($_POST['register-confirmed-password'])
){
    setMessage('RegisterHack', ['Non respect des règles du formulaire d\'inscription'],'danger');
    header('Location: error404.php');
    die();
}

$civility = $_POST['register-civility'];
$birthday = $_POST['register-birthday'];
$lastname = $_POST['register-lastname'];
$firstname = $_POST['register-firstname'];
$email = $_POST['register-email'];
$address = $_POST['register-address'];
$city = $_POST['register-city'];
$zipCode = $_POST['register-zip-code'];
$password = $_POST['register-password'];
$passwordConfirmed = $_POST['register-password-confirmed'];

$problems = [];
$supportedCivilties = ['M', 'F'];

if(!in_array($civility, $supportedCivilties)){
    $problems[] = 'Civilité non supportée';
}

$birthdayArray = explode('-',$birthday); // [YYYY,MM,DD]

if(!checkdate($birthdayArray[1] ,$birthdayArray[2] ,$birthdayArray[0]) || count($birthdayArray)!= 3){
    $problems[] = 'Format de la date de naissance incorrecte';
}else{ // Si le format de la date est correcte
    $ageInSeconds = time() - strtotime($birthday);
    $age = $ageInSeconds / (60/60/24/365.25); // (60/60/24/365.25) permet de convertir des secondes en années
    $problems[] = ($age < 18)? 'Vous devez avoir plus de 18 ans pour vous inscrire':null;
}

if(strlen($lastname) < 2 || strlen($lastname) > 180 || !ctype_alpha($lastname)){
    $problems[] = 'Le nom de famille doit être entre 2 et 180 caractères ALPHABETIQUES';
}

if(strlen($firstname) < 2 || strlen($firstname) > 100 || !ctype_alpha($firstname)){
    $problems[] = 'Le prénom doit être entre 2 et 100 caractères ALPHABETIQUES';
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $problems[] = 'Format de l\'adresse mail incorrecte';
}/*else{
    // Gérer si l'adresse mail existe déjà
}*/

if(strlen($address) < 2 || strlen($address) > 200 || !ctype_alnum($address)){
    $problems[] = 'L\'adresse doit comprendre entre 2 et 200 caractères alphanumériques (lettres et chiffres uniquements)';
}

if(strlen($city) < 2 || strlen($city) > 180 || !ctype_alpha($city)){
    $problems[] = 'La ville doit contenir entre 2 et 180 caractères ALPHABETIQUES';
}

if(strlen($zipCode)!= 5 || !ctype_digit($zipCode)){
    $problems[] = 'Le code postal doit contenir exactement 5 CHIFFRES';
}

if(checkPassword($password) === true){
    if($password != $passwordConfirmed){
        $problems[] = 'Les mots de passes ne correspondent pas';
    }
}else{
    $problems[] = 'Le mot de passe doit contenir 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial, 8 caractères minimum';
}

if(empty($problems)){
    $query = true;
    $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);
    echo '<pre>
               age = '. $age .'
               civilité = '. $civility .'
               nom = '. $lastname .'
               prenom = '. $firstname .'
               mail = '. $email .'
               adresse = '. $address .'
               ville = '. $city .'
               code postal = '. $zipCode .'
               mot de passe = '. $password .'
          </pre>';
}else{
    // Rajouter dans en session un message pop up contenant les problèmes invalidant l'inscription
    setMessage('Register', $problems, 'warning');
    header('Location: index.php');
    die();
}