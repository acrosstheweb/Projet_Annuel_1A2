<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message('Delete');
Message('CreateUser');
?>

<h1 class="aligned-title">Liste des utilisateurs</h1>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <nav class="nav flex-column py-3">
                <a class="nav-link active" href="<?= DOMAIN . 'modules/user/vues/admin/users.php'?>">Liste des utilisateurs</a>
                <a class="nav-link" aria-current="page" href="<?= DOMAIN . 'modules/user/vues/admin/security.php'?>">Sécurité</a>
                <a class="nav-link" href="#">jaaj 1</a>
                <a class="nav-link disabled">jaaj 2</a>
            </nav>
        </div>
    
        <div class="col-2">
            <a href="<?= DOMAIN . 'modules/user/scripts/admin/userCreateAdmin.php'?>" class="btn btn-primary">Créer un utilisateur</a>
        </div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Création d'un le l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Formulaire de création d'un nouvel utilisateur:
                <form id="createUserForm" action="../../scripts/admin/userCreateAdmin.php" method="POST">
                    <div class="createUserFormInfo">
                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="createUser-lastNameUid" class="fw-bold">Nom </label>
                                <input id="createUser-lastNameUid" class="form-control" type="text" name="createUser-lastName" required="required">
                            </div>
                            <div class="col-6">
                                <label for="createUser-firstNameUid" class="fw-bold">Prénom </label>
                                <input id="createUser-firstNameUid" class="form-control" type="text" name="createUser-firstName" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="createUser-birthdayUid" class="fw-bold">Date de naissance </label>
                                <input id="createUser-birthdayUid" class="form-control" type="date" name="createUser-birthday" required="required">
                            </div>
                            <div class="col-6">
                                <label for="createUser-emailUid" class="fw-bold">Adresse e-mail </label>
                                <input id="createUser-emailUid" class="form-control" type="email" name="createUser-email" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="createUser-zipCodeUid" class="fw-bold">Code postal </label>
                                <input id="createUser-zipCodeUid" class="form-control" type="text" name="createUser-zipCode" required="required">
                            </div>
                            <div class="col-6">
                                <label for="createUser-cityUid" class="fw-bold">Ville </label>
                                <input id="createUser-cityUid" class="form-control" type="text" name="createUser-city" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                    <label for="createUser-password" class="fw-bold">Mot de passe </label>
                                    <input id="createUser-password" class="form-control" type="password" name="createUser-password" required="required">
                                </div>
                            <div class="col-6">
                                <label for="createUser-passwordConfirm" class="fw-bold">Mot de passe confirmation</label>
                                <input id="createUser-passwordConfirm" class="form-control" type="password" name="createUser-passwordConfirm" required="required">
                            </div>
                    </div>
                    <div class="row mt-3 createUser-adminPassword">
                        <div class="col">
                            <label for="createUser-adminPasswordInputUid" class="fw-bold">Mot de passe Administrateur </label>
                            <input id="createUser-adminPasswordInputUid" class="form-control" type="password" name="createUser-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary createUser-confirm" form="createUserForm" type="submit">Créer le l'utilisateur</button>
            </div>
        </div>
    </div>
</div>

<?php
include "../../../../footer.php";
?>

<script src="<?= DOMAIN . 'js/admin-users.js'?>" crossorigin="anonymous"></script>