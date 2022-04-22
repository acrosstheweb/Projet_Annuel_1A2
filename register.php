<?php

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
    die("Non respect des règles d'inscription");
}

$gender = $_POST['register-gender'];
$birthday = $_POST['register-birthday'];
$lastname = strtoupper(trim($_POST['register-lastname']));
$firstname = ucwords(strtolower(trim($_POST['register-firstname'])));
$email = trim($_POST['register-email']);
$address = trim($_POST['register-address']);
$city = trim($_POST['register-city']);
$zip_code = trim($_POST['register-zip-code']);
$password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);
$confirmed_password = password_hash($_POST['register-confirmed-password'], PASSWORD_DEFAULT);

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

