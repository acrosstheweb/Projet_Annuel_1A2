<?php

require 'functions.php';

$data = "T";

if (isset($_GET['q'])) {
    $data = htmlspecialchars($_GET['q']);
}

$db = database();

$searchTopicQuery = $db->query("SELECT title, description FROM RkU_TOPIC WHERE title like '%$data%'");
$searchProgramQuery = $db->query("SELECT nameProgram FROM RkU_PROGRAM WHERE nameProgram like '%$data%'");
$searchAbonnementsQuery = $db->query("SELECT name, price FROM RkU_SUBSCRIPTION WHERE name like '%$data%'"); // Subscriptions c'est trop compliqué comme mot wej

if($searchTopicQuery){
    $results = $searchTopicQuery->fetchAll();
    echo "<br><h5>TOPICS</h5>";
    if(!empty($results)){
        foreach ($results as $key => $result){
            echo "<h6>" . $result['title'] . "</h6><p>" . $result['description'] . "</p><hr>";
        }
    }
    else{
        echo 'Aucun résultat';
    }
}

if($searchProgramQuery){
    $results = $searchProgramQuery->fetchAll();
    echo "<br><h5>PROGRAMMES</h5>";
    if(!empty($results)){
        foreach ($results as $key => $result){
            echo "<h6>" . $result['nameProgram'] . "</h6><hr>";
        }
    }
    else{
        echo 'Aucun résultat';
    }
}

if($searchAbonnementsQuery){
    $results = $searchAbonnementsQuery->fetchAll();
    echo "<br><h5>ABONNEMNETS</h5>";
    if(!empty($results)){
        foreach ($results as $key => $result){
            echo "<h6>" . $result['name'] . "</h6> - <h7>Tarif : " . $result['price'] . "€</h7><hr>";
        }
    }
    else{
        echo 'Aucun résultat';
    }
}