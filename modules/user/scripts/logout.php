<?php
require '../../../functions.php';

logout();
setMessage('Logout', ['Vous êtes bien deconnecté'], 'success');
header("Location: ../../../index.php");