<?php
require '../../../../functions.php';
if(
    empty($_POST['modify-lastName']) ||
    empty($_POST['modify-firstName']) ||
    empty($_POST['modify-birthday']) ||
    empty($_POST['modify-address']) ||
    empty($_POST['modify-zipCode']) ||
    empty($_POST['modify-city']) ||
    empty($_POST['modify-adminPasswordInput']) ||
    empty($_POST['modify-role']) ||
    empty($_POST['modify-fitcoins']) ||
    count($_POST) != 9
){
    header('Location: ../../../../error404.php');
    die();
}
$InputPwd = $_POST['modify-adminPasswordInput'];
$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $adminPwdInDb)){
    setMessage('Modify', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: ../../vues/admin/users.php');
    die();
}

$lastname = $_POST['modify-lastName'];
$firstname = $_POST['modify-firstName'];
$birthday = $_POST['modify-birthday'];
$address = $_POST['modify-address'];
$zipcode = $_POST['modify-zipCode'];
$city = $_POST['modify-city'];
$userToModifyId = htmlspecialchars($_GET['id']);
$role = $_POST['modify-role'];
$fictoins = $_POST['modify-fitcoins'];

if(!ctype_digit($role)){
    setMessage('Modify', ['Le rôle utilisateur doit être un chiffre'], 'warning');
    header('Location: ../../vues/admin/users.php');
    die();
}

if(!ctype_digit($fictoins) || $fictoins < 0){
    setMessage('Modify', ['Le nombre de fitcoins doit être un chiffre'], 'warning');
    header('Location: ../../vues/admin/users.php');
    die();
}

//TODO clean les champs avec checkFields();
$verifChamps = checkFields([
    'lastname' => $lastname,
    'firstname' => $firstname,
    'birthday' => $birthday,
    'address' => $address,
    'zipcode' => $zipcode,
    'city' => $city
]);

if($verifChamps[0] === true){
    $champs = $verifChamps[1];

    $userModifyQuery = $db->prepare("UPDATE RkU_USER SET lastname=:lastname, firstname=:firstname, birthday=:birthday, address=:address, zipcode=:zipcode, city=:city, role=:role, fitcoin=:fitcoins WHERE id=:id");
    $userModifyQuery->execute([
        "lastname" => $champs['lastname'],
        "firstname" => $champs['firstname'],
        "birthday" => $champs['birthday'],
        "address" => $champs['address'],
        "zipcode" => $champs['zipcode'],
        "city" => $champs['city'],
        "role" => $role,
        "id" => $userToModifyId,
        "fitcoins" => $fictoins
    ]);
    setMessage('Modify', ["L'utilisateur " . $firstname . ' ' . $lastname . " a bien été modifié."], 'success');
}else{
    setMessage('Modify', $verifChamps[1], 'warning');
}
header('Location: ../../vues/admin/users.php');
die();