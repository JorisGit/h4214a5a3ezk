<?php
function recupInfos($pseudo){
    
    global $BDD;
    
    $req = $BDD->prepare('SELECT * FROM profils WHERE pseudo = ?');
    $req->execute(array($pseudo));
    $donnees = $req->fetch();
    return $donnees;
}

function avatar($avatar, $pseudo) {
    global $BDD;
    
    if(isset($avatar) AND !empty($avatar['name'])) {
        $tailleFichierMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        if($avatar['size'] <= $tailleFichierMax) {
            $extensionUpload = strtolower(substr(strrchr($avatar['name'],'.'),1));
            if(in_array($extensionUpload, $extensionsValides)) {
                $chemin = "images/membres/avatar/".$pseudo.".".$extensionUpload;
                $deplacement = move_uploaded_file($avatar['tmp_name'], $chemin);
                if($deplacement) {
                    $update_avatar = $BDD->prepare('UPDATE profils SET avatar = :avatar WHERE pseudo = :pseudo');
                    $update_avatar->execute(array(
                    'avatar' => $pseudo.".".$extensionUpload,
                    'pseudo' => $pseudo
                    ));
                    $message = null;
                } else {
                    $message = "Il y a eu une erreur lors de votre importation d'avatar";
                }
            } else {
                $message = "Votre avatar n'a pas le bon type de fichier.";
            }
        } else {
            $message = "Votre avatar ne doit pas dépasser la taille maximale de 2Mo.";
        }
    } else {
        $message = null;
    }
    return $message;
}

function updateSports($pseudo, $sports) {
    
    $sportsDB = array('tennis', 'ping_pong', 'boxe', 'badminton', 'footing', 'velo', 'kayak', 'escalade', 'squash', 'natation', 'equitation', 'escrime');
    
    for($i = 0; $i < count($sports); $i++) {
        for($j = 0; $j < count($sportsDB); $j++) {
            if($sports[$i] == $sportsDB[$j]) {
                $sportsDB[$j] = 1;
            }
        }
    }
    
    for($i = 0; $i < count($sportsDB); $i++) {
        if(gettype($sportsDB[$i]) != "integer") {
            $sportsDB[$i] = 0;
        }
    }
    
    global $BDD;
    
    $req = $BDD->prepare('UPDATE profils SET tennis = ?, ping_pong = ?, boxe = ?, badminton = ?, footing = ?, velo = ?, kayak = ?, escalade = ?, squash = ?, natation = ?, equitation = ?, escrime = ? WHERE pseudo = ?');
    $req->execute(array(
    $sportsDB[0], $sportsDB[1], $sportsDB[2], $sportsDB[3], $sportsDB[4], $sportsDB[5], $sportsDB[6], $sportsDB[7], $sportsDB[8], $sportsDB[9], $sportsDB[10], $sportsDB[11], $pseudo
    ));
}

function updateDispo($pseudo, $dispo) {
    
    $dispoDB = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    
    for($i = 0; $i < count($dispo); $i++) {
        for($j = 0; $j < count($dispoDB); $j++) {
            if($dispo[$i] == $dispoDB[$j]) {
                $dispoDB[$j] = 1;
            }
        }
    }
    
    for($i = 0; $i < count($dispoDB); $i++) {
        if(gettype($dispoDB[$i]) != 'integer') {
            $dispoDB[$i] = 0;
        }
    }
    
    global $BDD;
    
    $req = $BDD->prepare('UPDATE profils SET lundi = ?, mardi = ?, mercredi = ?, jeudi = ?, vendredi = ?, samedi = ?, dimanche = ? WHERE pseudo = ?');
    $req->execute(array(
        $dispoDB[0], $dispoDB[1], $dispoDB[2], $dispoDB[3], $dispoDB[4], $dispoDB[5], $dispoDB[6], $pseudo
    ));
}

function updateVisibilite($pseudo, $visibilite) {
    global $BDD;
    
    $req = $BDD->prepare('UPDATE profils SET visibilite = ? WHERE pseudo = ?');
    $req->execute(array($visibilite, $pseudo));
}

function afficherAvatar($pseudo){
    global $BDD;
    $req = $BDD->prepare("SELECT * FROM profils WHERE pseudo ='$pseudo'");
    $req->execute();
    $resultat = $req->fetch();

    if(!empty($resultat['avatar'])){

        $afficherPdP = '<img src="images/membres/avatar/'.$resultat['avatar'].'" width="150"/>';
        return $afficherPdP;
    } else{
        return "Pas de photo de profil";
    }
}

function detectDepart($code_postal) {
    global $BDD;
    
    $departement = substr($code_postal, 0, 2);
    
    $req = $BDD->prepare('SELECT * FROM departement WHERE departement_code = ?');
    $req->execute(array($departement));
    
    $data = $req->fetch();
        
    return $departement.' - '.$data['departement_nom'];
}

function convertCPVille($code_postal) {
    global $BDD;
    
    if(substr($code_postal, 0, 2) == '75')
        return 'Paris';
    
    $req = $BDD->prepare('SELECT * FROM villes_france WHERE ville_code_postal = ?');
    $req->execute(array($code_postal));
    
    $data = $req->fetch();
    
    return $data['ville_nom_reel'].' ('.$code_postal.')';
    
}

function verifMdp($pseudo, $verif) {
    
    $verif = sha1($verif);
    
    global $BDD;
    $req = $BDD->prepare('
    SELECT * FROM profils WHERE pseudo = ? AND password = ?
    ');
    $req->execute(array($pseudo, $verif));
    $mdp = $req->fetch();
    
    if($mdp['password'] == $verif) {
        return true;
    } else {
        return false;
    }
}

function updateMdp($pseudo, $mdp) {
    $mdp = sha1($mdp);
    
    global $BDD;
    
    $req = $BDD->prepare('
    UPDATE profils SET password = ? WHERE pseudo = ?
    ');
    $req->execute(array($mdp, $pseudo));
}

function deleteProfil($pseudo) {
    global $BDD;
    
    $req = $BDD->prepare('
    DELETE FROM profils WHERE pseudo = ?
    ');
    $req->execute(array($pseudo));
}

?>