<?php

require 'functions.php';

$data = "T";

if (isset($_GET['q'])) {
    $data = htmlspecialchars($_GET['q']);
}

$db = database();

$searchQuery = $db->query("SELECT title FROM RkU_QUESTION WHERE title like '%$data%'");

if($searchQuery){
    $results = $searchQuery->fetchAll();
    foreach ($results as $key => $result){
        echo $result['title'];
    }
}