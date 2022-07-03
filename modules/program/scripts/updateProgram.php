<?php
    require '../../../functions.php';

    $db = database();

    // RÉCUPÉRATION DES DONNÉES POUR LA TABLE PROGRAM
    $programTitle = htmlspecialchars(ucwords(trim($_POST["programTitle"])));
    $programId = $_GET['id'];

    // RÉCUPÉRATION DES DONNÉES DANS LA TABLE PROGRAM
    $getProgramIllustrationQuery = $db->prepare("SELECT illustration FROM RkU_PROGRAM WHERE nameProgram=:nameProgram LIMIT 1");
    $getProgramIllustrationQuery->execute(["nameProgram"=>$programTitle]);
    $getProgramIllustration = $getProgramIllustrationQuery->fetch();

    // MODIFICATION DU NOM
    $updateProgramQuery = $db->prepare("UPDATE RkU_PROGRAM SET nameProgram=:nameProgram WHERE id=:id");
    $updateProgramQuery->execute([
        "id" => $programId,
        "nameProgram" => $programTitle
    ]);

    // MODIFICATION DE L'ILLUSTRATION
    if(!empty($_FILES['programFile']['name'])){
        $tempNameImage = trim($_FILES['programFile']['tmp_name']);
        $nameImage = trim($_FILES['programFile']['name']);
        $type = $_FILES['programFile']['type'];

        $extensionsAllowed = ['png', 'jpg', 'jpeg'];
        $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
        
        if(in_array($type, $typeImage)){
            unlink(ABSOLUTE_PATH . $getProgramIllustration['illustration']);
            move_uploaded_file($tempNameImage, ABSOLUTE_PATH . 'sources/img/' . $nameImage);

            $updateProgramQuery = $db->prepare("UPDATE RkU_PROGRAM SET illustration=:illustration WHERE id=:id");
            $updateProgramQuery->execute([
                "id" => $programId,
                'illustration' => 'sources/img/' . $nameImage
            ]);
        } else{
            setMessage('updateProgram', ['Image non valide'], 'warning');
            header('Location: ' . DOMAIN . 'modules/user/vues/admin/adminPrograms.php');
            die();
        }
    }

    // MODIFICATION DES EXERCICES
    $deleteExercicesQuery = $db->prepare("DELETE FROM RkU_CONTAINS WHERE programId=:programId");
    $deleteExercicesQuery->execute([
        'programId' => $programId
    ]);
    
    for ($i = 1; $i <= ((count($_POST)-1)/3); $i++){
        $exercice = $_POST['programExerciceDropdown'.$i];
        $series = $_POST['programSeries'.$i];
        $reps = $_POST['programReps'.$i];

        $insertProgramQuery = $db->prepare("INSERT INTO RkU_CONTAINS (programId, exerciceId, series, repeats) VALUES (:programId, :exerciceId, :series, :repeats)");
        $insertProgramQuery->execute([
            'programId' => $programId,
            'exerciceId' => $exercice,
            'series' => $series,
            'repeats' => $reps
        ]);
    }

    setMessage('updateProgram', ['Programme créé'], 'success');
    header('Location: ' . DOMAIN . 'modules/user/vues/admin/adminPrograms.php');
    die();
