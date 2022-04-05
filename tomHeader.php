<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content=<?php if(isset($content)){echo $content;}else{echo "Bienvenue sur Fitness Essential";} ?>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title><?php if(isset($title)){echo $title;}else{echo "Fitness Essential";} ?></title>
</head>
<body>

<?php
    include "register.php";
    include "login.php";

    function isActive($active_page, $link){
        if($active_page == $link){
            echo "active";
        }
    }
?>

<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="index.php" class="navbar-brand"><img src="https://i.pinimg.com/originals/53/95/62/539562c1bfb175bdb99d3cc77e6a1622.jpg" alt="logo"></a>
    </nav>



</header>