<?php
    require '../../../functions.php';

    // si l'user n'est pas connecté, alors le formulaire vient de la modale
    if (!isConnected()){
        if(!empty($_POST['newsletterInput'])){
            $email = htmlspecialchars($_POST['newsletterInput']);
            // si l'e-mail est associé à un compte
            if (checkFields(['email'=>$email], true)[0] == false){
                $db = database();
                $getUserInfoQuery = $db->prepare("SELECT id FROM RkU_USER WHERE email=:email");
                $getUserInfoQuery->execute(['email'=>$email]);
                $userId = $getUserInfoQuery->fetch()['id'];

                subscribe($userId);

                setMessage('newsletter', ['Inscription à la newsletter réussie'], 'success');
                header('Location: ' . DOMAIN);
                die();
            } else {
                setMessage('newsletter', ['Créez vous d\'abord un compte'], 'info');
                header('Location: ' . DOMAIN);
                die();
            }
        }

    // sinon, le formulaire vient de la page préférences
    } elseif (!empty($_GET['id'])){
        $userId = $_GET['id'];
        if (is_numeric($_POST['newsletterRadio'])){
            $value = $_POST['newsletterRadio'];
            if ($value == 1){
                subscribe($userId);

                setMessage('newsletter', ['Inscription à la newsletter réussie'], 'success');
                header('Location: ' . DOMAIN . 'modules/user/vues/profilePageNewsletter.php');
                die();
            }
            elseif ($value == 2){
                unsubscribe($userId);
                
                setMessage('newsletter', ['Désinscription à la newsletter réussie'], 'success');
                header('Location: ' . DOMAIN . 'modules/user/vues/profilePageNewsletter.php');
                die();
            } else {
                header('Location: ' . DOMAIN . 'error404.php');
                die();
            }
        }

    // sinon, il fait n'imp
    } else {
        header('Location: ' . DOMAIN . 'error404.php');
        die();
    }

    function subscribe(int $id){
        $db = database();
        $updateNewsletterQuery = $db->prepare("UPDATE RkU_USER SET newsletter=1 WHERE id=:id");
        $updateNewsletterQuery->execute(['id' => $id]);
    }

    function unsubscribe(int $id){
        $db = database();
        $updateNewsletterQuery = $db->prepare("UPDATE RkU_USER SET newsletter=2 WHERE id=:id");
        $updateNewsletterQuery->execute(['id' => $id]);
    }

    header('Location: ' . DOMAIN . 'modules/user/vues/profilePageNewsletter.php');
    die();