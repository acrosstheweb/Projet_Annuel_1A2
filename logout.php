<?php
require 'functions.php';

unset($_SESSION['userToken']);
unset($_SESSION['userId']);
setMessage('Logout', ['Vous êtes bien deconnecté'], 'success');
header("Location: index.php");