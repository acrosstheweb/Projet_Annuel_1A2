<?php
require '../../../functions.php';

logout();
session_start();
setMessage('Logout', ['Vous êtes bien deconnecté'], 'success');
header("Location: ../../../index.php");