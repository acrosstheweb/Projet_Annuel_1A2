<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Page profil";
    $content = "Profil utilisateur";
    $currentPage = 'profile';
    require '../../../header.php';
    Message('Update');
    $db = database();
    $getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email, civility, avatar, address, city, zipCode, birthday, registrationDate FROM RkU_USER WHERE id=:id");
    $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
    $user = $getUserInfoQuery->fetch();
?>

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row">

        <div class="d-none col-2 mx-md-3 d-md-flex justify-content-center">
            <?php include 'profilePageNavbar.php'; ?>
        </div>
        
        <div class="col-12 col-md-8">
            
        </div>
    </div>
</div>

<?php
    include '../../../footer.php';
?>