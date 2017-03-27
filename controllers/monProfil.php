<?php
require 'models/monProfil.php';

if(isset($_POST['modif'])) {
    $sports = array();
    if(isset($_POST['tennis'])) {
        array_push($sports, 'tennis');
    } if(isset($_POST['pingpong'])) {
        array_push($sports, 'ping_pong');
    } if(isset($_POST['boxe'])) {
        array_push($sports, 'boxe');
    } if(isset($_POST['badminton'])) {
        array_push($sports, 'badminton');
    } if(isset($_POST['footing'])) {
        array_push($sports, 'footing');
    } if(isset($_POST['velo'])) {
        array_push($sports, 'velo');
    } if(isset($_POST['kayak'])) {
        array_push($sports, 'kayak');
    } if(isset($_POST['escalade'])) {
        array_push($sports, 'escalade');
    } if(isset($_POST['squash'])) {
        array_push($sports, 'squash');
    } if(isset($_POST['natation'])) {
        array_push($sports, 'natation');
    } if(isset($_POST['equitation'])) {
        array_push($sports, 'equitation');
    } if(isset($_POST['escrime'])) {
        array_push($sports, 'escrime');
    }
    
    $dispo = array();
    if(isset($_POST['lundi'])) {
        array_push($dispo, 'lundi');
    } if(isset($_POST['mardi'])) {
        array_push($dispo, 'mardi');
    } if(isset($_POST['mercredi'])) {
        array_push($dispo, 'mercredi');
    } if(isset($_POST['jeudi'])) {
        array_push($dispo, 'jeudi');
    } if(isset($_POST['vendredi'])) {
        array_push($dispo, 'vendredi');
    } if(isset($_POST['samedi'])) {
        array_push($dispo, 'samedi');
    } if(isset($_POST['dimanche'])) {
        array_push($dispo, 'dimanche');
    }
    
    $avatar = $_FILES['avatar'];
    $message = avatar($avatar, $_SESSION['pseudo']);
    
    if(count($sports) != 0) {
        if(isset($_SESSION['nosport'])) {
            unset($_SESSION['nosport']);
        }
        updateSports($_SESSION['pseudo'], $sports);
    } else {
        $message = 'Veuillez cocher un sport au moins';
    }
    
    if(count($dispo) != 0) {
        updateDispo($_SESSION['pseudo'], $dispo);
    }
    
    updateVisibilite($_SESSION['pseudo'], $_POST['visibilite']);
    
} else if (isset($_POST['apply'])) {
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp2 = htmlspecialchars($_POST['mdp2']);
    $verif = htmlspecialchars($_POST['verif']);
    if(isset($_POST['delete'])) {
        $delete = $_POST['delete'];
    }
    
    if(!empty($verif)) {
        if(verifMdp($_SESSION['pseudo'], $verif)) {
            if(!empty($mdp) && !empty($mdp2)) {
                    if($mdp == $mdp2) {
                        updateMdp($_SESSION['pseudo'], $mdp);
                        $message = 'Changement bien pris en compte';
                    } else {
                        $message = 'Les mots de passes ne se correspondent pas';
                    }
            } else if(empty($mdp) && !empty($mdp2) || !empty($mdp) && empty($mdp2)) {
                $message = 'Veuillez remplir les deux champs mot de passe';
            }
            
        } else {
            $message = 'Mot de passe de vérification incorrect';
        }
        
        if(isset($delete)) {
            deleteProfil($_SESSION['pseudo']);
            session_destroy();
            header('Location: index.php?p=accueil');
        }
    }
}

include 'views/monProfil.php';
?>