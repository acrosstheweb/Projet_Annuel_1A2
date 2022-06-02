<?php
require '../../../functions.php';

/*unset($_SESSION['userToken']);
unset($_SESSION['userId']);*/
atw_log($_SESSION['userId'], "Logout");
session_destroy();
session_start();
setMessage('Logout', ['Vous êtes bien deconnecté'], 'success');
header("Location: ../../../index.php");