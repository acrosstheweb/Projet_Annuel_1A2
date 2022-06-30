<?php
  $title = "Fitness Essential - Panier";
  $content = "Votre panier";
  $currentPage = 'cart';

  require_once '../../../functions.php';

  $pdo = database();

  if(!isConnected()){
    echo "Pour accéder à votre panier, merci de vous connecter";
    die();
  }

  $subTotal = 0;

  /**
   * Permet de supprimer l'abonnement du panier
   * @param $_GET['delSubscription']
   */
  if(isset($_GET['delSubscription'])){
    unset($_SESSION['subscription']);
    SetMessage("deleteSubCart", ["L'abonnement a bien été supprimé de votre panier"], "success");
    header("Location: cart.php");
    die();
  }


  /**
   * Permet de supprimer l'article de Fitcoins du panier (peu importe la quantité)
   * @param $_GET['delFitcoins']
   */
  if(isset($_GET['delFitcoins'])){
    unset($_SESSION['fitcoins'][$_GET['delFitcoins']]);
    SetMessage("deleteFitcoinsCart", ["L'article a bien été supprimé de votre panier"], "success");
    header("Location: cart.php");
    die();
  }

  /**
   * Permet de réduire la quantité d'un article, si la quantité vaut 1 alors ca supprime l'article
   * @param $_GET['changeQuantityFitcoinsMinus']
   */
  if(isset($_GET['changeQuantityFitcoinsMinus'])){

    if($_SESSION['fitcoins'][$_GET['changeQuantityFitcoinsMinus']] == 1){
      unset($_SESSION['fitcoins'][$_GET['changeQuantityFitcoinsMinus']]);
      SetMessage("deleteFitcoinsCart", ["L'article a bien été supprimé de votre panier"], "success");
      header("Location: cart.php");
      die();
    }
    $_SESSION['fitcoins'][$_GET['changeQuantityFitcoinsMinus']]--;
    SetMessage("changeFitcoinsCart", ["La quantité a bien été modifiée"], "success");
    header("Location: cart.php");
    die();
  }

  /**
   * Permet d'augmenter la quantité d'un article
   * @param $_GET['changeQuantityFitcoinsMinus']
   */
  if(isset($_GET['changeQuantityFitcoinsPlus'])){
      $_SESSION['fitcoins'][$_GET['changeQuantityFitcoinsPlus']]++;
      SetMessage("changeFitcoinsCart", ["La quantité a bien été modifiée"], "success");
      header("Location: cart.php");
      die();
  }

  require '../../../header.php';
  Message("deleteSubCart");
  Message("deleteFitcoinsCart");
  Message("changeFitcoinsCart");
      
?>

<h1 class="text-center">Votre panier</h1>

<?php 
if(isset($_SESSION['subscription'])){

    $subscriptionId = $_SESSION['subscription'][0];

    $reqSubscription = $pdo->prepare("SELECT * FROM RkU_SUBSCRIPTION WHERE id=:id");
    $reqSubscription->execute([
        'id'=>$subscriptionId
    ]);
    $result = $reqSubscription->fetch();

?>

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-11 col-lg-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 text-center">
                        <img class=" my-2" src="<?= DOMAIN . 'sources/img/' . $result['path'] ?>" class="img-fluid rounded-top rounded-md-start" alt="image de l'abonnement">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title">Abonnement <?= $result['name'] ?></h5>
                            <div class="row">
                                <div class="col-8 p-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text __cartBtn"><a href="cart.php?delSubscription=<?= $subscriptionId ?>"><i class="fa-solid fa-trash-can"></i></a></span>
                                        <span class="input-group-text">1</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <p class="card-text text-end"><?= $result['price'] ?> €</p>
                                </div>
                            </div>
                        <?php $subTotal += $result['price'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <?php } ?>

        <?php
        if(isset($_SESSION['fitcoins'])){
            $ids = array_keys($_SESSION['fitcoins']);
            $idsImplode = implode(',', $ids);

            if(empty($ids)){
                $packs = [];
            }
            else{
                $reqPacks = $pdo->query("SELECT * FROM RkU_FITCOINS WHERE id IN (".$idsImplode.")");
                $packs = $reqPacks->fetchAll();
            }

            foreach($packs as $pack){
        ?>


    <div class="row d-flex justify-content-center">
        <div class="col-11 col-lg-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 text-center">
                        <img src="<?= DOMAIN . 'sources/img/fitcoin.svg' ?>" class="img-fluid rounded-start mx-1 p-3 __cartImage" alt="image de l'abonnement">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pack['name'] ?></h5>
                            <div class="row">
                                <div class="col-8 p-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text __cartBtn"><?= ($_SESSION['fitcoins'][$pack['id']] == 1) ? '<a href="cart.php?delFitcoins=' . $pack['id'] . '"><i class="fa-solid fa-trash-can"></i>' : '<a href="cart.php?changeQuantityFitcoinsMinus=' . $pack['id'] . '"><i class="fa-solid fa-minus"></i>'  ?></a></span>
                                        <span class="input-group-text"><?= $_SESSION['fitcoins'][$pack['id']] ?></span>
                                        <span class="input-group-text __cartBtn"><a href="cart.php?changeQuantityFitcoinsPlus=<?= $pack['id'] ?>"><i class="fa-solid fa-plus"></i></a></span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <p class="card-text text-end"><?= $pack['price']?> €</p>
                                </div>
                            </div>
                            <?php $subTotal += $pack['price'] * $_SESSION['fitcoins'][$pack['id']]?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php }} ?>




    <div class="row d-flex justify-content-center">
        <div class="col-10 col-lg-6 fw-bold">
            <hr>
            <span class="text-uppercase">Sous-total:</span>
            <span class="float-end"><?= $subTotal ?> €</span>
        </div>
    </div>
</div>

<?php 
    include '../../../footer.php';
?>