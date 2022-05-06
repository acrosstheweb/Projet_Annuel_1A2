<?php
    $title = "Fitness Essential - Écrivez-nous";
    $content = "Création d'un message sur le forum";
    $currentPage = 'message';
    include 'header.php';
?>

<h2 class="aligned-title"> Une question? Écrivez-nous </h2>

<p class="text-center">Nos équipes sont à votre écoute pour répondre à vos questions.</p>

<div class="row d-flex justify-content-center">
    <form action="" method="POST" class="col-10 col-md-8 col-lg-6 my-3">
        <div class="row my-3">
            <label for="messageForum">Sélectionnez un forum : </label>
            <select class="form-select" name="messageForum" id="messageForum"><br>
                <option selected>Forum</option>
                <option value="Alimentation">Alimentation</option>
                <option value="Abdos-Fessiers">Abdos-Fessiers</option>
                <option value="CrossFit">CrossFit</option>
                <option value="Cycling">Cycling</option>
                <option value="HIIT">HIIT</option>
                <option value="Pilates">Pilates</option>
                <option value="Yoga">Yoga</option>
                <option value="Zumba">Zumba</option>
            </select>
        </div>

        <div class="row my-3">
            <label for="messageSubject">Posez-nous votre question : </label>
            <input class="form-control" type="text" name="messageSubject" id="messageSubject" placeholder="Sujet"><br>
        </div>

        <div class="row my-3">
            <label for="messageDescription">Décrivez-nous votre problème : </label>
            <textarea class="form-control" name="messageDescription" id="messageDescription" placeholder="Message" rows="5"></textarea>
        </div>

        <div class="row my-3">
            <label for="file" class="form-label">Ajoutez une image</label>
            <input class="form-control" type="file" id="file" name="file">
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Publier</button>
        </div>
    </form>
</div>

<?php
    include 'footer.php';
?>