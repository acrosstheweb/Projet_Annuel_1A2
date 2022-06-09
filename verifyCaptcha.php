<?php
    require "functions.php";
    echo "<pre>";
    var_dump($_POST);

    var_dump($_SESSION['captcha']);

    echo "</pre>";

    echo '<br>';

    if ($_POST['__tile0'] == $_SESSION['captcha'][0] &&
        $_POST['__tile1'] == $_SESSION['captcha'][1] &&
        $_POST['__tile2'] == $_SESSION['captcha'][2] &&
        $_POST['__tile3'] == $_SESSION['captcha'][3] &&
        $_POST['__tile4'] == $_SESSION['captcha'][4] &&
        $_POST['__tile5'] == $_SESSION['captcha'][5] &&
        $_POST['__tile6'] == $_SESSION['captcha'][6] &&
        $_POST['__tile7'] == $_SESSION['captcha'][7] &&
        $_POST['__tile8'] == $_SESSION['captcha'][8]
    ){
        echo 'bravo!';
    } else {
        echo 'fréro, tu es cringe';
    }
    // unset($_SESSION['captcha']);
