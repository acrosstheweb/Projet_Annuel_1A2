<?php
    require '../../../functions.php';
    if(!isConnected()){
        header('Location: error404.php');
        die();
    }
    $title = "Fitness Essential - Mes prochaines séances";
    $content = "Mes prochaines séances";
    $currentPage = 'nextBookings';
    require '../../../header.php';
    Message('Update');
    $db = database();
    $getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email, civility, avatar, address, city, zipCode, birthday, registrationDate FROM RkU_USER WHERE id=:id");
    $getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
    $user = $getUserInfoQuery->fetch();
?>
<div class="container-fluid d-md-none">
    <div class="row __profileDropdown">
        <div class="dropdown d-grid gap-2">
            <button class="btn dropdown-toggle text-light" type="button" id="__profileDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $content ?>
            </button>
            <ul class="dropdown-menu justify-content-center __profileDropdownMenu text-light" aria-labelledby="dropdownMenuButton1">
                <?php include 'profilePageNavbar.php'; ?>
            </ul>
        </div>
    </div>
</div>

<h2 class="aligned-title"> Mes prochaines séances </h2>
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