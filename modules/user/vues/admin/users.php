<?php
require '../../../../functions.php';

	if(!isAdmin()) {
        header('Location: ../../../../error404.php');
        die();
    }

require '../../../../header.php';
Message('Delete');
Message('Modify');
Message('CreateUser');
?>

<h1 class="aligned-title">Liste des utilisateurs</h1>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <?php include "adminNavbar.php"; ?>
        </div>
    
        <div class="col-8">
            <div class="text-end my-3">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Créer un utilisateur</a>
            </div>
            <div class="col-4">
                <li class="input-group rounded">
                    <input id="__search-user" type="search" class="form-control rounded" placeholder="Chercher l'adresse mail d'un utilisateur" aria-label="Search" aria-describedby="search-addon" oninput="searchUser()">
                </li>
            </div>
            <table class="table" id="__usersTable">
                <thead>
                    <tr>
                        <th onclick="sortColumn(0, '__usersTable')" id="tableHeaderSortable">Id</th>
                        <th onclick="sortColumn(1, '__usersTable')" id="tableHeaderSortable">Email</th>
                        <th onclick="sortColumn(2, '__usersTable')" id="tableHeaderSortable">Nom</th>
                        <th onclick="sortColumn(3, '__usersTable')" id="tableHeaderSortable">Prénom</th>
                        <th onclick="sortColumn(4, '__usersTable')" id="tableHeaderSortable">Date de naissance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $pdo = database();
                        
                        $query = $pdo->query("SELECT * FROM RkU_USER");
                        $results = $query->fetchAll();

                        foreach($results as $user)
                        {
                            $userId = $user["id"];
                            $userMail = $user["email"];
                            $userLastName = $user["lastName"];
                            $userFirstName = $user["firstName"];
                            $userBirthday = $user["birthday"];
                            $userAddress = $user["address"];
                            $userZipCode = $user["zipCode"];
                            $userCity = $user["city"];
                            ?>

                                <tr class="__userRow">
                                    <td><?php echo $userId;?></td>
                                    <td><?php echo $userMail;?></td>
                                    <td><?php echo $userLastName;?></td>
                                    <td><?php echo $userFirstName;?></td>
                                    <td><?php echo $userBirthday;?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-primary modifyModal--trigger" data-bs-toggle="modal" data-bs-target="#modifyModalUid<?php echo $userId;?>">Modifier</a>
                                            <a href="#" class="btn btn-danger deleteModal--trigger" data-bs-toggle="modal" data-bs-target="#delModalUid<?php echo $userId;?>">Supprimer</a>
                                        </div>

                                    </td>

                                </tr>

                                <div class="modal fade" id="modifyModalUid<?php echo $userId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification des informations de l'utilisateur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Vous êtes sur le point de modifier les informations de l'utilisateur suivant:
                                                <form id="modifyUserFormUid<?php echo $userId;?>" action="../../scripts/admin/userModifyAdmin.php?id=<?php echo $userId;?>" method="POST">
                                                    <div class="modifyFormInfo">
                                                        <div class="row mt-3">
                                                            <div class="col-6">
                                                                <label for="modify-lastNameUid<?php echo $userId;?>" class="fw-bold">Nom </label>
                                                                <input id="modify-lastNameUid<?php echo $userId;?>" class="form-control" type="text" name="modify-lastName" value="<?php echo $userLastName;?>" required="required">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="modify-firstNameUid<?php echo $userId;?>" class="fw-bold">Prénom </label>
                                                                <input id="modify-firstNameUid<?php echo $userId;?>" class="form-control" type="text" name="modify-firstName" value="<?php echo $userFirstName;?>" required="required">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="modify-birthdayUid<?php echo $userId;?>" class="fw-bold">Date de naissance </label>
                                                                <input id="modify-birthdayUid<?php echo $userId;?>" class="form-control" type="date" name="modify-birthday" value="<?php echo $userBirthday;?>" required="required">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <label for="modify-emailUid<?php echo $userId;?>" class="fw-bold">Adresse e-mail </label>
                                                                <p id="modify-emailUid<?php echo $userId;?>" class="form-control"><?php echo $userMail;?></p>
                                                                <small class="form-text text-muted">Seul le propriétaire du compte peut modifier son adresse mail</small>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <label for="modify-addressUid<?php echo $userId;?>" class="fw-bold">Adresse </label>
                                                                <input id="modify-addressUid<?php echo $userId;?>" class="form-control" type="text" name="modify-address" value="<?php echo $userAddress;?>" required="required">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="modify-zipCodeUid<?php echo $userId;?>" class="fw-bold">Code postal </label>
                                                                <input id="modify-zipCodeUid<?php echo $userId;?>" class="form-control" type="text" name="modify-zipCode" value="<?php echo $userZipCode;?>" required="required">
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="modify-cityUid<?php echo $userId;?>" class="fw-bold">Ville </label>
                                                                <input id="modify-cityUid<?php echo $userId;?>" class="form-control" type="text" name="modify-city" value="<?php echo $userCity;?>" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 modify-adminPassword">
                                                        <div class="col">
                                                            <label for="modify-adminPasswordInputUid<?php echo $userId;?>" class="fw-bold">Mot de passe Administrateur </label>
                                                            <input id="modify-adminPasswordInputUid<?php echo $userId;?>" class="form-control" type="password" name="modify-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary modify-passwordConfirm">Modifier</button>
                                                <button class="btn btn-primary modify-confirm" form="modifyUserFormUid<?php echo $userId;?>" type="submit">Modifier</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delModalUid<?php echo $userId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Suppression d'un utilisateur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="deleteUserFormUid<?php echo $userId;?>" action="../../scripts/admin/userDelAdmin.php?id=<?php echo $userId;?>" method="POST" >
                                                    <div class="deleteFormInfo">
                                                        <h5>Vous êtes sur le point de supprimer l'utilisateur suivant:</h5>
                                                        <div class="row">
                                                            <p class="col"><strong>Nom</strong><br><?php echo $userLastName;?></p>
                                                            <p class="col"><strong>Prénom</strong><br><?php echo $userFirstName;?></p>
                                                        </div>
                                                        <div class="row">
                                                            <p><strong>Adresse e-mail</strong><br><?php echo $userMail;?></p>
                                                        </div>
                                                        <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le supprimer?</p>
                                                    </div>
                                                    <div class="row delete-adminPassword">
                                                        <div class="col">
                                                            <label for="delete-adminPasswordInput" class="fw-bold">Mot de passe Administrateur </label>
                                                            <input id="delete-adminPasswordInput" class="form-control" type="password" name="delete-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary delete-passwordConfirm">Supprimer</button>
                                                <button class="btn btn-primary delete-confirm" form="deleteUserFormUid<?php echo $userId;?>" type="submit">Supprimer</button>
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

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Création d'un utilisateur</h5>
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
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary createUser-confirm" form="createUserForm" type="submit">Créer l'utilisateur</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include "../../../../footer.php";
?>

<script src="<?= DOMAIN . 'js/admin-users.js'?>" crossorigin="anonymous"></script>