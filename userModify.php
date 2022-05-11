<?php
    require "header.php";

    //redirectIfNotConnected();

	if(!empty($_SESSION['errors'])){
		
		?>

		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  
			  <?php
					foreach($_SESSION['errors'] as $error){

						echo "<li>".$error;

					}
			  ?>

			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

		<?php



		//session_destroy()
		unset($_SESSION['errors']);

	}

    $pdo = database();
    $queryPrepared = $pdo->prepare("SELECT * FROM rku_user WHERE id=:id");
    $queryPrepared->execute([
        "id"=>$_GET["id"]
    ]);

    $result = $queryPrepared->fetch();

?>

<h1 class="aligned-title">Modification des informations sur l'utilisateur</h1>
<div class="row m-4">
    <div class="col-2"></div>
    <div class="col-8">
        <form method="POST" action="userModify.php?id=<?php echo $_GET["id"]?>">
            <label for="modify-Email" class="form-label">Adresse e-mail</label>
            <input class="form-control" id="modify-Email" type="email" name="email" value=<?php echo $result["email"]?> required="required"><br>
            
            <label for="modify-FirstName" class="form-label">Prénom</label>
			<input class="form-control" id="modify-FirstName" type="text" name="firstname" value=<?php echo $result["firstName"]?>><br>
            
            <label for="modify-LastName" class="form-label">Nom</label>
			<input class="form-control" id="modify-LastName" type="text" name="lastname" value=<?php echo $result["lastName"]?>><br>
            
            <label for="modify-Birthday" class="form-label">Date de naissance</label>
			<input class="form-control" id="modify-Birthday" type="date" name="birthday" value=<?php echo $result["birthday"]?> required="required"><br>
            
            <label for="modify-Country" class="form-label">Pays</label>
            <select class="form-control" id="modify-Country" name="country" value=<?php echo $result["country"]?>>
                <option value="fr">France</option>
                <option value="pl">Polish</option>
                <option value="dz">Djazair</option>
            </select><br><br>

            <div class="alert alert-secondary" role="alert">
                Ne remplir ces champs que si vous souhaiter changer de mot de passe.
            </div>
            <label for="modify-Password" class="form-label">Mot de passe</label>
            <input class="form-control" id="modify-Password" type="password" name="pwd" placeholder="Nouveau mot de passe"><br>
			
            <label for="modify-PasswordConfirm" class="form-label">Mot de passe de confirmation</label>
            <input class="form-control" id="modify-PasswordConfirm"type="password" name="pwdConfirm" placeholder="Confirmation du nouveau mot de passe"><br><br>
            
            <input class="form-control" type="submit" value="Enregistrer les modifications">
            </form>
    </div>
</div>
