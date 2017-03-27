<?php
require 'models/rencontre.php';

$recupDep = recupDepartement();

if(isset($_POST['filtre'])){
    
    $sport = $_POST['sport'];
    $sport = strtolower($sport);
    $sexe = $_POST['sexe'];
    $ageMini = $_POST['ageMini'];
    $ageMax = $_POST['ageMax'];
    $departement = $_POST['departement'];
    
    $dispo = array();
    if(isset($_POST['lundi'])) {
        $lundi = true;
        array_push($dispo, 'lundi');
    } if(isset($_POST['mardi'])) {
        $mardi = true;
        array_push($dispo, 'mardi');
    } if(isset($_POST['mercredi'])) {
        $mercredi = true;
        array_push($dispo, 'mercredi');
    } if(isset($_POST['jeudi'])) {
        $jeudi = true;
        array_push($dispo, 'jeudi');
    } if(isset($_POST['vendredi'])) {
        $vendredi = true;
        array_push($dispo, 'vendredi');
    } if(isset($_POST['samedi'])) {
        $samedi = true;
        array_push($dispo, 'samedi');
    } if(isset($_POST['dimanche'])) {
        $dimanche = true;
        array_push($dispo, 'dimanche');
    }
    
    if (substr($departement, 0, 2) == '97') {
        $departement = substr($departement, 0, 3);
        echo $departement;
    } else {
        $departement = substr($departement,0, 2);
    }
    
    $departement = strval($departement);
    
}
    include 'views/rencontre.php';
?>