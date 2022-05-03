<?php
session_start();

function checkPassword($password): bool{
    $hasDigits = (preg_match('/\d/',$password) === 1);
    $hasLowerCase = (preg_match('/[a-zéèêëàâîïôöûü]/',$password) === 1); // (de a-z + éèêëàâîïôöûü) == minuscules
    $hasUpperCase = (preg_match('/[A-Z]/',$password) === 1);
    $hasSpecialChar = (preg_match('/[^\p{L}\p{N}\éèêëàâîïôöûü]/',$password) === 1); // Négation de (Lettres, Chiffres, accents) == Special chars
    $has8chars = (strlen($password) >= 8);

    if($hasDigits && $hasLowerCase && $hasUpperCase && $hasSpecialChar && $has8chars){
        return true;
    }else{
        return false;
    }
}

function setMessage($title, $msgArray, $type){
    $_SESSION['MESSAGE'][$title] = [
        'content' => $msgArray,
        'type' => $type
    ];
}

function Message($title){
    if(isset($_SESSION['MESSAGE'][$title])){
        $type = $_SESSION['MESSAGE'][$title]['type'];
        foreach($_SESSION['MESSAGE'][$title]['content'] as $msg){
            if($msg != NULL){
            echo "<div class='alert alert-{$type}' alert-dismissible fade show role='alert'>
                      {$msg}
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
            }
        }
        unset($_SESSION['MESSAGE'][$title]);
    }
}

function database(){
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=fitness_essential;port=3306", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur lors de la connexion à la base de données :  " . $e->getMessage());
    }
    return $pdo;
}