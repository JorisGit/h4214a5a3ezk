<?php
require 'models/connexion.php';
if (isset($_POST["email"])) {
    
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['password']);
    
    $verif = verifUser($email, $mdp);
    
    if ($verif == 1) {
        $mailConfirm = mailConfirm($email);
        if($mailConfirm) {
        $_SESSION['email'] = $email;
        $_SESSION['pseudo'] = dataUser($email)['pseudo'];
            if (dataUser($email)['tennis'] == 1 || dataUser($email)['ping_pong'] == 1 || dataUser($email)['boxe'] == 1 || dataUser($email)['badminton'] == 1 || dataUser($email)['footing'] == 1 || dataUser($email)['velo'] == 1 || dataUser($email)['kayak'] == 1 || dataUser($email)['escalade'] == 1 || dataUser($email)['squash'] == 1 || dataUser($email)['natation'] == 1 || dataUser($email)['equitation'] == 1 || dataUser($email)['escrime'] == 1) {
                header('Location: index.php?p=rencontre');
            } else {
                $_SESSION['nosport'] = true;
                header('Location: index.php?p=mon-profil');
            }
        } else {
            $message = 'Veuillez confirmer votre adresse mail';
        }
    } else {
        $message = 'Erreur mdp ou email';
    }
}
include 'views/connexion.php';
?>