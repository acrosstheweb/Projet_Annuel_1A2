<?php
session_start();

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

function setToken($id){
    $chars = ['$','^','@','&','(','-','_',')','='];
    $n1 = rand(0,9); $n2 = rand(0,9);
    $c1 = $chars[array_rand($chars)]; $c2 = $chars[array_rand($chars)];
    $prefix = "{$c1}{$n1}{$c2}{$n2}";
    $tk = uniqid($prefix);

    $db = database();
    $setTokenQuery = $db->prepare('UPDATE RkU_user SET token=:tk WHERE id=:id');
    $setTokenQuery->execute(['tk'=> $tk, 'id'=> $id]);

    return $tk;
}

function isConnected(){
    if(empty($_SESSION['userToken'])){
        return false; // Si il n'y a pas de token en session, isConnected = false
    }else{
        $db = database();
        $getTokenDbQuery = $db->prepare("SELECT token from RkU_user WHERE id=:id");
        $getTokenDbQuery->execute(['id' => $_SESSION['userId']]);
        
        $tokenDb = $getTokenDbQuery->fetch()['token'];
        $tokenSession = $_SESSION['userToken'];
        if($tokenDb == $tokenSession){
            return true;
        }else{
            return false;
        }
        
    }

}

function isAdmin(){
    if(!isConnected()){
        return false;
    }

    // Lorsque connecté l'user ID est disponible en session
    $db = database();
    $getRoleDbQuery = $db->prepare("SELECT role from RkU_user WHERE id=:id");
    $getRoleDbQuery->execute(['id' => $_SESSION['userId']]);

    $roleDb = $getRoleDbQuery->fetch()['role'];
    if($roleDb >= 1){
        return true;
    }else{
        return false;
    }
}

/*function getUser($fields){
    // Fonction qui récupère les champs depuis la bdd grâce à un id;
    // Pour chaque $fields, retourner la valeur en bdd
}*/