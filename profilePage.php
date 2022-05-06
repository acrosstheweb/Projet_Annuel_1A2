<?php
    $title = "Fitness Essential - Page profil";
    $content = "Profil utilisateur";
    $currentPage = 'profile';
    include 'header.php';
?>

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-1">
            <nav class="nav flex-column py-3">
                <a class="nav-link active" aria-current="page" href="#">Mon Profil</a>
                <a class="nav-link" href="#">Sécurité</a>
                <a class="nav-link" href="#">jaaj 1</a>
                <a class="nav-link disabled">jaaj 2</a>
            </nav>
        </div>
        <div class="col-8">

            <div class="row border-bottom py-3">
                <img src="sources/img/avatar.jpg" alt="" class="img-fluid col-2">
                <div class="col-8">
                    <p class="d-flex align-items-start fw-bold fs-3">Jean Bombeur</p>
                    <p class="d-flex align-items-end">
                        <a href="#" class="link-primary">Modifier mes informations</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <form>
                    <div class="col-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">
                            <p class="fw-bold my-0">Nom</p>
                            <p class="my-0">test</p>
                        </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>