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

<h1>Votre panier</h1>

<?php 
if(isset($_SESSION['subscription'])){

    $subscriptionId = $_SESSION['subscription'][0];

    $reqSubscription = $pdo->prepare("SELECT * FROM RkU_SUBSCRIPTION WHERE id=:id");
    $reqSubscription->execute([
        'id'=>$subscriptionId
    ]);
    $result = $reqSubscription->fetch();

?>

<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?= DOMAIN . 'sources/img/' . $result['path'] ?>" class="img-fluid rounded-start" alt="image de l'abonnement">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Abonnement <?= $result['name'] ?></h5>
        <p class="card-text">Prix : <?= $result['price'] ?></p>
        <a href="cart.php?delSubscription=<?= $subscriptionId ?>">Supprimer</a>
        <?php $subTotal += $result['price'];?>
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


<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?= DOMAIN . 'sources/img/' . $pack['path'] ?>" class="img-fluid rounded-start" alt="image de l'abonnement">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $pack['name'] ?></h5>
        <p class="card-text">Prix : <?= $pack['price']?></p>
        <p><a href="cart.php?changeQuantityFitcoinsMinus=<?= $pack['id'] ?>">-</a><?= $_SESSION['fitcoins'][$pack['id']] ?><a href="cart.php?changeQuantityFitcoinsPlus=<?= $pack['id'] ?>">+</a></p>
        <a href="cart.php?delFitcoins=<?= $pack['id'] ?>">Supprimer tout</a>

        <?php $subTotal += $pack['price'] * $_SESSION['fitcoins'][$pack['id']]?>
      </div>
    </div>
  </div>
</div>


<?php }} ?>



<div class="container">
    <h4>Sous-total : <?= $subTotal ?>€</h4>
</div>