<?php
session_start();

function webroot(): string
{
    return $_SERVER['DOCUMENT_ROOT'] . '/Projet_Annuel_1A2_github/';
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

function genToken(){
    $chars = ['$','^','@','&','(','-','_',')','='];
    $n1 = rand(0,9); $n2 = rand(0,9);
    $c1 = $chars[array_rand($chars)]; $c2 = $chars[array_rand($chars)];
    $prefix = "{$c1}{$n1}{$c2}{$n2}";
    $tk = uniqid($prefix);
    return strrev($tk);
}

function setToken($id){
    $tk = genToken();
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
    if($roleDb >= 2){
        return true;
    }else{
        return false;
    }
}

/*
 * checkFields retourne un tableau de 2 éléments un booléen et un tableau. Dans le cas où la vérification se passe bien le booléen vaut true et le tableau contient les champs, prêts à être insérés en BDD; Sinon le booléen vaut false et le tableau contient les problemes de la vérification.
 * checkFields gère un tableau de champ, les champs gérés sont : 'civility', 'lastname', 'firstname', 'birthday', 'email', 'address', 'city', 'zipcode'
 */
function checkFields($fields): array
{
    $results = [];
    $problems = [];
    $exceptions = [' ','-','é','è','ê','ë','à','â','î','ï','ô','ö','û','ü']; // Tableau qui permet de laisser passer ses caractères dans les vérifications des champs (les lettres accentuées n'étant pas reconnu comme des caractères alphabétiques)

    foreach($fields as $field){
        switch (array_search($field, $fields)){
            case 'civility':
                $civility = $fields['civility'];
                $supportedCivilties = ['M', 'F'];
                if(!in_array($civility, $supportedCivilties)){
                    $problems[] = 'Civilité non supportée';
                }else{
                    $results['civility'] = $civility;
                }
                break;
            case 'lastname':
                $lastname = strtoupper($fields['lastname']);
                if(strlen($lastname) < 2 || strlen($lastname) > 180 || !ctype_alpha(str_replace($exceptions, '', $lastname))){
                    $problems[] = 'Le nom de famille doit être entre 2 et 180 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
                }else{
                    $results['lastname'] = strtoupper($lastname);
                }
                break;
            case 'firstname':
                $firstname = $fields['firstname'];
                if(strlen($firstname) < 2 || strlen($firstname) > 100 || !ctype_alpha(str_replace($exceptions, '', $firstname))){
                    $problems[] = 'Le prénom doit être entre 2 et 100 caractères alphabétiques'; // Alphabétique + $exceptions autorisés
                }else{
                    $results['firstname'] = ucwords(strtolower($firstname));
                }
                break;
            case 'birthday':
                $birthday = $fields['birthday'];
                $birthdayArray = explode('-',$birthday); // From "YYYY-MM-DD To [YYYY,MM,DD]

                if(!checkdate($birthdayArray[1] ,$birthdayArray[2] ,$birthdayArray[0]) || count($birthdayArray)!= 3 || strlen((string)$birthdayArray[0]) > 4){
                    $problems[] = 'Format de la date de naissance incorrecte';
                }else{ // Si le format de la date est correcte
                    $ageInSeconds = time() - strtotime($birthday);
                    $age = $ageInSeconds / (60*60*24*365.25); // (60*60*24*365.25) permet de convertir des secondes en années

                    if($age < 18){
                        $problems[] = 'Vous devez avoir plus de 18 ans pour vous inscrire';
                    }elseif($age > 122){
                        $problems[] = 'Je doute que vous ayez ' . round($age) . ' ans. La doyenne de l\'humanité n\'a vécu que 122 ans, revoyez votre date de naissance svp';
                    }else{
                        $results['birthday'] = strtoupper($birthday);
                    }
                }
            case 'email':
                $email = $fields['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $problems[] = 'Format de l\'adresse mail incorrecte';
                }else{
                    // Gére si l'adresse mail existe déjà
                    $db = database();

                    $checkUserExistQuery = $db->prepare("SELECT id FROM rku_user WHERE email=:email LIMIT 1");
                    $checkUserExistQuery->execute(["email"=>$email]);
                    $checkUserExist = $checkUserExistQuery->fetch();

                    if(!empty($checkUserExist)){
                        $problems[] = "Ce mail est déjà utilisé";
                    }else{
                        $results['email'] = strtolower(trim($email));
                    }
                }
                break;
            case 'address':
                $address = $fields['address'];
                if(strlen($address) < 2 || strlen($address) > 200 || !ctype_alnum(str_replace($exceptions, '', $address))){
                    $problems[] = 'L\'adresse doit comprendre entre 2 et 200 caractères alphanumériques'; // Alphnumériques + $exceptions autorisés
                }else{
                    $results['address'] = ucwords(strtolower($address));
                }
                break;
            case 'city':
                $city = $fields['city'];
                if(strlen($city) < 2 || strlen($city) > 180 || !ctype_alpha(str_replace($exceptions, '', $city))){
                    $problems[] = 'La ville doit contenir entre 2 et 180 caractères alphabétiques'; // Alphabétiques + $exceptions autorisés
                }else{
                    $results['city'] = ucwords(strtolower($city));
                }
                break;
            case 'zipcode':
                $zipcode = $fields['zipcode'];
                if(strlen($zipcode)!= 5 || !ctype_digit($zipcode)){
                    $problems[] = 'Le code postal doit contenir exactement 5 chiffres';
                }else{
                    $results['zipcode'] = ucwords(strtolower($zipcode));
                }
                break;
            case 'password':
                $pwd = $fields['password'];
                if(!checkPassword($pwd)){
                    $problems[] = 'Le mot de passe doit contenir 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial, 8 caractères minimum';
                }else{ // Si le mdp a les bons critères
                    $results['password'] = password_hash($pwd, PASSWORD_DEFAULT);
                }
                break;
            case 'password-confirm': // On part du principe que s'il y'a un champ password-confirm c'est qu'il y'a un champ password renseigné avant
                $pwdConfirm = $fields['password-confirm'];
                if(!isset($pwd)){
                    $problems[] = 'Erreur champs password et/ou password-confirm';
                }else{
                    if($pwd != $pwdConfirm){
                        $problems[] = 'Les mots de passe ne correspondent pas';
                    }
                }
                break;
            default:
                $problems[] = "Le champ '". $field ."' n'est pas géré";
                break;
        }
    }
    if(count($problems) == 0){

        return [true, $results];

    }else{
        return [false, $problems];
    }
}
/* JEU DE TEST POUR checkFieds
echo "<pre>";
    var_dump(checkFields([
        "lastname" => "BOMBEUR",
        "firstname" => "Jean",
        "civility" => "M",
        "birthday" => "2003-06-07",
        "email" => "wissem.derghalz@gmail.com",
        "city" => "Saint-Ours",
        "zipcode" => "73410"
    ]));
    echo "</pre>";
*/

/*
 * $domain correspond au serveur sur lequel le script est executé, si local alors mettre http://localhost/Projet_Annuel_1A2_github, si prod mettre = pat-atw.fr
 * $tk correspond au token qui est utilisé pour identifier l'inscription d'un nouvel utilisateur, il est envoyé dans le mail et est inséré en BDD
 */
function register_mail($firstname, $tk, $domain): string
{
    return "<!DOCTYPE html>
        <html>
            <section align='center'>
                <h1>Vérification inscription Fitness Essential</h1>
                <img src='https://pa-atw.fr/sources/img/logo.png' alt='logo'>
                <h3>Bonjour " . $firstname . ", merci de nous faire confiance pour être la salle de vos nombreux futurs entrainements intensifs 💪</h3>
                <p>Pour confirmer votre inscription nous vons prions de bien vouloir cliquer sur le lien afin de vérifier que vous n'êtes pas un robot 🔌</p>
                <a href='$domain/confirmRegister.php?fn=$firstname&tk=$tk'>Vérifier votre addresse mail</a>
            </section>
        </html>";
}

/*function getUser($fields){
    // Fonction qui récupère les champs depuis la bdd grâce à un id;
    // Pour chaque $fields, retourner la valeur en bdd
}*/