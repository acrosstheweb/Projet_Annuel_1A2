<?php
session_start();

if(
    count($_POST) != 10 ||
    empty($_POST['register-gender']) ||
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
    /* Que faire lors du non respect des regles ?*/
    die("Non respect des jaaj d'inscription");
}

$problems = [];
$supported_gender = ['M','F'];
$clean_names_regex = "/^([a-zA-Z' ]+)$/";


$gender = $_POST['register-gender'];
$birthday = $_POST['register-birthday'];
$lastname = strtoupper(trim($_POST['register-lastname']));
$firstname = ucwords(strtolower(trim($_POST['register-firstname'])));
$email = trim($_POST['register-email']);
$address = trim($_POST['register-address']);
$city = trim($_POST['register-city']);
$zip_code = trim($_POST['register-zip-code']);
$password = $_POST['register-password'];
$confirmed_password = $_POST['register-confirmed-password'];

if(!in_array($gender, $supported_gender)){
    $problems[] = "arrête de jaajer le html";
}

$birthday_array = explode('-',$birthday); // Passage d'une date au format YYYY-MM-DD à un tableau [YYYY,MM,DD]
if(count($birthday_array)!=3 || !checkdate($birthday_array[1],$birthday_array[2],$birthday_array[0])){
    $problems[] = "Format de date invalide";
}else{
    $sec_to_year = 60*60*24*365.25;
    $age = (time() - strtotime($birthday)) / $sec_to_year; // (Différence entre le timestamp UNIX et la date en timestamp) -> Convertie en année
    if($age < 18 || $age > 100){
        $problems[] = "L'âge requis pour s'inscrire doit être en 18 et 100 ans";
    }
}

if(strlen($lastname) < 2 || strlen($lastname) > 100 || !preg_match($clean_names_regex,$lastname)){
    $problems[] = "Le nom de famille doit être compris entre 2 et 100 caractères et ne doit contenir que des caractères alphabétiques (A à Z) ou un tiret";
}

if(strlen($firstname) < 2 || strlen($firstname) > 100 || !preg_match($clean_names_regex,$firstname)){
    $problems[] = "Le prénom doit être compris entre 2 et 100 caractères et ne doit contenir que des caractères alphabétiques (A à Z) ou un tiret";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $problems[] = "Format de l'adresse mail invalide";
}/*else{
    // Check si l'adresse mail existe déjà en bdd
}*/

if(strlen($address) < 10 || strlen($address) > 200){
    $problems[] = "L'adresse doit faire entre 10 et 200 caractères";
}

if(strlen($city) < 4 || strlen($city) > 100 || ctype_digit($city)){
    $problems[] = "La ville doit faire entre 4 et 100 caractères et ne doit pas comporter de chiffres";
}


if(strlen($zip_code)!=5 || !ctype_digit($zip_code)){
    $problems[] = "Le code postal doit contenir exactement 5 chiffres";
}

if(strlen($password) < 8){
    $problems[] = "Le mot de passe doit faire obligatoirement plus de 8 caractères";
}else{
    if($password != $confirmed_password){
        $problems[] = "Le mot de passe de confirmation ne correspond pas au mot de passe";
    }
}

if(empty($problems)){
    $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);
    echo '<pre>
               age = '. $age .'
               civilité = '. $gender .'
               nom = '. $lastname .'
               prenom = '. $firstname .'
               mail = '. $email .'
               adresse = '. $address .'
               ville = '. $city .'
               code postal = '. $zip_code .'
               mot de passe = '. $password .'
          </pre>';
}else{
    $_SESSION['register_problems'] = $problems;
    print_r($problems);
}


/*
name="register-gender"
name="register-birthday"
name="register-lastname"
name="register-firstname"
name="register-email"
name="register-address"
name="register-city"
name="register-zip-code"
name="register-password"
name="register-confirmed-password"
10 champs à verifier
*/

