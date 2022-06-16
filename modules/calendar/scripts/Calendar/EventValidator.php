<?php

require '../../../../functions.php';

$pdo = database();

// var_dump($_FILES); echo "<br>";
// var_dump($_POST); 
// die();
    
if(!empty($_POST)){
    extract($_POST);
    $valid = true;
    $errors = [];

    if(isset($_POST['createEvent'])){
        $date = $_POST;
        $name = trim($_POST['eventName']);
        $description = trim($_POST['eventDescription']);
        $date = $_POST['eventDate'];
        $start = DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $_POST['eventStart'])->format('Y-m-d H:i:s');
        $end = DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $_POST['eventEnd'])->format('Y-m-d H:i:s');
        $price = $_POST['eventPrice'];
        $sport = $_POST['eventSport'];
        $gym = $_POST['eventGym'];
        
        if(empty($name)){
            $valid = false;
            $errors = ("Il faut donner un nom à l'évènement");
        }

        if(strlen($name) < 3 || strlen($name) > 50){
            $valid = false;
            $errors = ("Il faut que le nom fasse entre 3 et 50 caractères ");
        }

        if(empty($description)){
            $valid = false;
            $errors = ("Il faut ajouter une description à l'évènement");
        }

        if(strlen($description > 500)){
            $valid = false;
            $errors = ("La description doit faire moins de 500 caractères");
        }
        
        if(empty($date)){
            $valid = false;
            $errors = ("Il faut ajouter une date");
        }

        $dateArray = explode('-',$date); // From "YYYY-MM-DD To [YYYY,MM,DD]
        
        if(!checkdate($dateArray[1] ,$dateArray[2] ,$dateArray[0]) || count($dateArray)!= 3 || strlen((string)$dateArray[0]) > 4){
            $valid = false;
            $errors = ("Format de la date incorrecte");
        }
            
        if(empty($start)){
            $valid = false;
            $errors = ("Il faut ajouter une heure de début");
        }

        if(empty($end)){
            $valid = false;
            $errors = ("Il faut ajouter une heure de fin");
        }

        if(empty($price)){
            $valid = false;
            $errors = ("Il faut ajouter un prix");
        }

        if(empty($sport)){
            $valid = false;
            $errors = ("Il faut ajouter un prix");
        }

        if(empty($gym)){
            $valid = false;
            $errors = ("Il faut ajouter un prix");
        }

        if( strtotime($end) - strtotime($start) < 0){
            $valid = false;
            $errors = ("Il faut que l'heure de fin soit supérieure à l'heure de début");
        }
    }

    //insertion base de données si valide à faire
    if ($valid) {
    
        $insertEventQuery = $pdo->prepare("INSERT INTO RkU_BOOKING (name, description, startDate, endDate, status, price, sport, gym)
                VALUES 
                (:name, :description, :startDate, :endDate, :status, :price, :sport, :gym)");

        $insertEventQuery->execute([
            'name'=>$name,
            'description'=>$description,
            'startDate'=>$start,
            'endDate'=>$end,
            'status'=>1,
            'price'=>$price,
            'sport'=>$sport,
            'gym'=>$gym
        ]);

        setMessage('createEvent', ['Votre nouvel évènement a bien été créée'], 'success');
        header('Location: ../../vues/reservations.php');
        exit;
    }
    else{
        setMessage('createEvent', [$errors], 'warning');
        header('Location: ../../vues/addNewEvent.php');
        exit;
    }
        

}

?>