<?php
    $title = "Fitness Essential - À propos";
    $content = "Les coachs et directeurs de Fitness Essential";
    $currentPage = 'about';
    require 'header.php';

    $pdo = database();

    $reqGym = $pdo->query("SELECT * FROM RkU_GYMS");
    $results = $reqGym->fetchAll();
?>

<h2 class="aligned-title"> Nos salles </h2>

<div class="container-fluid">
    <?php
    foreach($results as $gym){
        $reqCity = $pdo->prepare("SELECT name, ZIPCode FROM RkU_CITY WHERE id=:id");
        $reqCity->execute([
            'id'=>$gym['city']
        ]);
        $city = $reqCity->fetch();
    ?>

    <div class="__gym">
        <div class="row d-flex justify-content-center align-items-center __gymDescription">

    <?php
        if ($gym['id'] % 2 ==0){
    ?>
        
            <div class="col-12 col-lg-6 p-3 __gymMapContainer">
                <iframe class="__gymMap" src="<?php echo $gym['link'];?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
            <div class="col-12 col-lg-6">
                <ul class="__gymInfo">
                    <li class="fw-bold fs-1 text-uppercase"><?php echo $gym['name'];?></li>
                    <li class="text-muted small"><?php echo $gym['surfaceArea'];?>m<sup>2</sup></li>
                    <li class="fs-3 mt-3"><?php echo $gym['address'].'<br>'.$city['ZIPCode'].' '.$city['name'];?></li>
                    <li class="my-3"><?php echo $gym['phoneNumber'];?></li>
                </ul>
            </div>
    
    <?php
        } else {
    ?>
        
            <div class="col-12 col-lg-6 p-3">
                <ul class="__gymInfo">
                    <li class="fw-bold fs-1 text-uppercase"><?php echo $gym['name'];?></li>
                    <li class="text-muted small"><?php echo $gym['surfaceArea'];?>m<sup>2</sup></li>
                    <li class="fs-3 mt-3"><?php echo $gym['address'].'<br>'.$city['ZIPCode'].' '.$city['name'];?></li>
                    <li class="my-3"><?php echo $gym['phoneNumber'];?></li>
                </ul>
            </div>
            <div class="col-12 col-lg-6 __gymMapContainer">
                <iframe class="__gymMap" src="<?php echo $gym['link'];?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>

    <?php
        }
    ?>

        </div>
    </div>

    <?php
        }
    ?>
</div>

        <!-- <iframe width="600" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=oto%20recovery%20place&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->

<?php
    include 'footer.php';
?>