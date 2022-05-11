<?php
require "header.php";
?>


<h1 class="aligned-title">Liste des utilisateurs</h1>

<?php
	if(isConnected()){
?>

<div class="row d-flex justify-content-center">
    <div class="col-10">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Email</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Date de naissance</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$pdo = database();
				
				$query = $pdo->query("SELECT * FROM rku_user");
				$results = $query->fetchAll();

				foreach($results as $user)
				{
					?>

						<tr>
							<td><?php echo $user["id"]?></td>
							<td><?php echo $user["email"]?></td>
							<td><?php echo $user["lastName"]?></td>
							<td><?php echo $user["firstName"]?></td>
							<td><?php echo $user["birthday"]?></td>
							<td>
								<div class="btn-group">
									<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyModal">Modifier</a>
									<a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">Supprimer</a>
								</div>

							</td>

						</tr>

						<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Suppression d'un utilisateur</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Vous êtes sur le point de supprimer l'utilisateur suivant:
									<div class="row">
										<p class="col"><strong>Nom</strong><br><?php echo $user["lastName"]?></p>
										<p class="col"><strong>Prénom</strong><br><?php echo $user["firstName"]?></p>
									</div>
									<div class="row">
										<p><strong>Adresse e-mail</strong><br><?php echo $user["email"]?></p>
									</div>
									Êtes-vous sûr de vouloir le supprimer?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
									<a href="userDel.php?id=<?php echo $user["id"]?>" class="btn btn-danger">Supprimer</a>
								</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modification des informations de l'utilisateur</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Vous êtes sur le point de modifier les informations de l'utilisateur suivant:
									<form id="modify-form" action="register.php" method="POST">
										<div class="row mt-3">
											<div class="col-6">
												<label for="modify-lastName" class="fw-bold">Nom </label>
												<input id="modify-lastName" class="form-control" type="text" name="modify-lastName" value="<?php echo $user["lastName"]?>" required="required">
											</div>
											<div class="col-6">
												<label for="modify-firstName" class="fw-bold">Prénom </label>
												<input id="modify-firstName" class="form-control" type="text" name="modify-firstName" value="<?php echo $user["firstName"]?>" required="required">
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<label for="modify-birthday" class="fw-bold">Date de naissance </label>
												<input id="modify-birthday" class="form-control" type="date" name="modify-birthday" value="<?php echo $user["birthday"]?>" required="required">
											</div>
										</div>
										<div class="row mt-3">
											<div class="col">
												<label for="modify-email" class="fw-bold">Adresse e-mail </label>
												<input id="modify-email" class="form-control" type="email" name="modify-email" value="<?php echo $user["email"]?>" required="required">
											</div>
										</div>
										<div class="row mt-3">
											<div class="col">
												<label for="modify-address" class="fw-bold">Adresse </label>
												<input id="modify-address" class="form-control" type="text" name="modify-address" value="<?php echo $user["address"]?>" required="required">
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<label for="modify-zipCode" class="fw-bold">Code postal </label>
												<input id="modify-zipCode" class="form-control" type="text" name="modify-zipCode" value="<?php echo $user["zipCode"]?>" required="required">
											</div>
											<div class="col-6">
												<label for="modify-city" class="fw-bold">Ville </label>
												<input id="modify-city" class="form-control" type="text" name="modify-city" value="<?php echo $user["city"]?>" required="required">
											</div>
										</div>
										<div class="row mt-3" id="modify-adminPassword">
											<div class="col">
												<label for="modify-adminPasswordInput" class="fw-bold">Mot de passe Administrateur </label>
												<input id="modify-adminPasswordInput" class="form-control" type="email" name="modify-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
									<a href="#" class="btn btn-primary" id="modify-passwordConfirm">Modifier</a>
									<a href="userModify.php?id=<?php echo $user["id"]?>" class="btn btn-primary" id="modify-confirm">Modifier</a>
								</div>
								</div>
							</div>
						</div>

					<?php

				}


			?>





		</tbody>
	</table>
    </div>
</div>


<?php
	}
?>


<?php

include "footer.php";

?>

<script src="js/modifyUserAdmin.js" crossorigin="anonymous"></script>