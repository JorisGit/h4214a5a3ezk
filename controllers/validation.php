<?php
global $BDD;

if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty ($_GET['key'])){
    $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
    $key = $_GET['key'];

    $requser = $BDD->prepare("SELECT * FROM profils WHERE pseudo = ?");
    $requser->execute(array($pseudo));
    $userexist = $requser->rowCount();
    
    if($userexist == 1){
        $user = $requser->fetch();
        if($user['etat'] == 0){
            $updateuser = $BDD->prepare("UPDATE profils SET etat = 1 WHERE pseudo = ? AND confirmkey = ?");
            $updateuser->execute(array($pseudo,$key));
            $message = "Votre compte a été vérifié";
        } else {
            $message = "Votre compte a déjà été confirmé";
        }
    } else {
        $message = "L'utilisateur n'existe pas";
    }
}

include 'views/validation.php';

?>