<?php
    require '../../../functions.php';

    $db = database();

    // RÉCUPÉRATION DES DONNÉES POUR LA TABLE PROGRAM
    $programTitle = htmlspecialchars(ucwords(trim($_POST["programTitle"])));

    // VÉRIFICATION DES DONNÉES POUR LA TABLE PROGRAM
    $checkProgramExistQuery = $db->prepare("SELECT id FROM RkU_PROGRAM WHERE nameProgram=:nameProgram LIMIT 1");
    $checkProgramExistQuery->execute(["nameProgram"=>$programTitle]);
    $checkProgramExist = $checkProgramExistQuery->fetch();


    if(!empty($_FILES['programFile'])){
        $tempNameImage = trim($_FILES['programFile']['tmp_name']);
        $nameImage = trim($_FILES['programFile']['name']);
        $type = $_FILES['programFile']['type'];

        $extensionsAllowed = ['png', 'jpg', 'jpeg'];
        $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
    
        if(in_array($type, $typeImage)){
            move_uploaded_file($tempNameImage, ABSOLUTE_PATH . 'sources/img/' . $nameImage);
        }
    }

    if(!empty($checkProgramExist)){
        // setMessage('Nom de programme déjà utilisé');
        header('Location: ' . DOMAIN . 'modules/user/vues/admin/adminPrograms.php');
        die();
    } else {
        $insertProgramQuery = $db->prepare("INSERT INTO RkU_PROGRAM (nameProgram, illustration) VALUES (:nameProgram, :illustration)");
        $insertProgramQuery->execute([
            'nameProgram' => $programTitle,
            'illustration' => 'sources/programs/' . $nameImage
        ]);
        
        $getProgramId = $db->prepare('SELECT id FROM RkU_PROGRAM WHERE nameProgram = :nameProgram LIMIT 1');
        $getProgramId->execute([ 'nameProgram' => $programTitle ]);
        $result = $getProgramId->fetch();

        for ($i = 1; $i <= ((count($_POST)-1)/3); $i++){
            $exercice = $_POST['programExerciceDropdown'.$i];
            $series = $_POST['programSeries'.$i];
            $reps = $_POST['programReps'.$i];

            $insertProgramQuery = $db->prepare("INSERT INTO RkU_CONTAINS (programId, exerciceId, series, repeats) VALUES (:programId, :exerciceId, :series, :repeats)");
            $insertProgramQuery->execute([
                'programId' => $result['id'],
                'exerciceId' => $exercice,
                'series' => $series,
                'repeats' => $reps
            ]);
        }
    }

    // setMessage('Programme créé');
    header('Location: ' . DOMAIN . 'modules/user/vues/admin/adminPrograms.php');
    die();
