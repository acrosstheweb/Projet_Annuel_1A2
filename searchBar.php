<?php

require 'functions.php';

$data = "T";

if (isset($_GET['q'])) {
    $data = htmlspecialchars($_GET['q']);
}

$db = database();

$searchQuery = $db->query("SELECT title, description FROM RkU_TOPIC WHERE title like '%$data%' OR description like '%$data%'");

if($searchQuery){
    $results = $searchQuery->fetchAll();
    if(!empty($results)){
        foreach ($results as $key => $result){
            echo $result['title'] . " - " . $result['description'] . "<br>";
        }
    }
    else{
        echo 'Aucun résultat';
    }
}