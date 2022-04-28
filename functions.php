<?php
session_start();

function checkPassword($password){

    $hasDigits = preg_match('[0-9]',$password);
    $hasLowerCase = preg_match('[a-z]',$password);
    $hasUpperCase = preg_match('[A-Z]',$password);
    $hasSpecialChar = preg_match('[^A-Za-z0-9]',$password);
    $has8chars = (strlen($password) >= 8);

    if($hasDigits && $hasLowerCase && $hasUpperCase && $hasSpecialChar && $has8chars){
        return true;
    }else{
        return false;
    }
}

function setMessage($title, $msgArray, $type){

    $_SESSION['MESSAGE'][$title] = [
        'text' => $msgArray,
        'type' => $type
    ];
}

function Message($title){
    $type = $_SESSION['MESSAGE'][$title]['type'];
    foreach($_SESSION['MESSAGE'][$title]['text'] as $msg){
        if($msg != NULL){
        echo "<div class='alert alert-{$type}' alert-dismissible fade show role='alert'>
                  {$msg}
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
        }
    }
}