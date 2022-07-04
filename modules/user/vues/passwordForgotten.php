<?php

require '../../../header.php';

Message('newPassword');
?>

    <div class="container-fluid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Formulaire d'envoi d'une demande de réinitialisation du mot de passe. <br>
                    <form id="passwordForgotForm" action="../scripts/newPassword.php" method="POST">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="passwordForgotten-email" class="fw-bold">Adresse e-mail </label>
                                <input id="passwordForgotten-email" class="form-control" type="email" name="passwordForgotten-email" required="required">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary passwordForgotten-confirm" form="passwordForgotForm" type="submit">Envoyer la demande</button>
                </div>
            </div>
        </div>
    </div>

<?php
include "../../../footer.php";