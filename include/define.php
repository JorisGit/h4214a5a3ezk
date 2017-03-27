<?php
    $accueil = 'accueil';
    $inscription = 'inscription';
    $connexion = 'connexion';
    $deconnexion = 'deconnexion';
    $monProfil = 'mon-profil';
    $rencontre = 'rencontre';
    $validation = 'validation';

    switch($p) {
        case $inscription:
            $title = 'Inscription';
        break;
        case $connexion:
            $title = 'Connexion';
        break;
        case $monProfil:
            if(isset($_SESSION['pseudo']))
                $pseudo = $_SESSION['pseudo'];
            else
                $pseudo = 'invité';
            $title = 'Profil de ';
        break;
        case $rencontre:
            $title = 'Rencontre';
        break;
        case $validate:
            $title = 'Validation';
        break;
        default:
            $title = 'Accueil';
        break;
    }
?>