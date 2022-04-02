<!-- Modal Inscription -->
<section class='modal' id='modal-register'>
    <div class="modal-content">
        <header class='modal-header'>
            <h3>Inscription</h3>
            <button class='modal-close'>&times;</button> <!-- &times; est un charactère unicode correspondant au signe de multiplication (x) -->
        </header>
        
        <form action='' id='form-register'>
            <label for="input-mail">Adresse email : </label>
            <input type='email' name='mail' id='input-mail' placeholder='Adresse email'><br>
            <label for="input-passwd">Mot de passe : </label>
            <input type='password' name='passwd' id='input-passwd' placeholder='Mot de passe'>
        </form>

        <footer class='modal-footer'>
            <button class='modal-close'>Annuler</button>
            <button type='submit' form='form-register'>S'inscrire</button>
        </footer>
    </div>
</section>