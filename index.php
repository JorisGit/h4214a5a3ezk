<?php
include_once 'include/config.php';

$p = (isset($_GET['p'])) ? $_GET['p'] : 'index';

$heure = date("H:i");

if($heure == '00:00') {
require 'models/update.php';
    
    $liste_user = dataUser();
    while ($user = $liste_user->fetch()) {
        if(substr($user['date_naissance'], 0, 5) == date("d/m"))
            updateAge($user['date_naissance'], $user['pseudo']);
    }
}

include_once 'include/define.php';

switch($p) {
    case $accueil:
        include 'controllers/accueil.php';
    break;
    case $inscription:
        if(!isset($_SESSION["email"])) {
            include 'controllers/inscription.php';
        } else {
            header('Location: index.php?p=accueil');
        }
    break;
    case $connexion:
        if(!isset($_SESSION["email"])) {
            include 'controllers/connexion.php';
        } else {
            header('Location: index.php?p=accueil');
        }
    break;
    case $deconnexion:
        include 'controllers/deconnexion.php';
    break;
    case $monProfil:
        if(isset($_SESSION["email"])) {
            include 'controllers/monProfil.php';
        } else {
            header('Location: index.php?p=accueil');
        }
    break;
    case $rencontre:
        if(isset($_SESSION["email"])) {
            if(!isset($_SESSION["nosport"])) {
                include 'controllers/rencontre.php';
            } else {
                header('Location: index.php?p=mon-profil');
            }
        } else {
            header('Location: index.php?p=accueil');
        }
    break;
    case $validation:
        include 'controllers/validation.php';
    break;
    default:
        header('Location: index.php?p=accueil');
    break;
}

?>