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
    count($_POST) != 7
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
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: ../../vues/admin/users.php');
    die();
}

$lastname = $_POST['modify-lastName'];
$firstname = $_POST['modify-firstName'];
$birthday = $_POST['modify-birthday'];
$address = $_POST['modify-address'];
$zipcode = $_POST['modify-zipCode'];
$city = $_POST['modify-city'];
$userToModifyId = $_GET['id'];

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

    $userModifyQuery = $db->prepare("UPDATE RkU_USER SET lastname=:lastname, firstname=:firstname, birthday=:birthday, address=:address, zipcode=:zipcode, city=:city WHERE id=:id");
    $userModifyQuery->execute([
        "lastname" => $champs['lastname'],
        "firstname" => $champs['firstname'],
        "birthday" => $champs['birthday'],
        "address" => $champs['address'],
        "zipcode" => $champs['zipcode'],
        "city" => $champs['city'],
        "id" => $userToModifyId
    ]);
    setMessage('Modify', ["L'utilisateur n°" . $userToModifyId . " a bien été modifié."], 'success');
}else{
    setMessage('Modify', $verifChamps[1], 'warning');
}
header('Location: ../../vues/admin/users.php');
die();