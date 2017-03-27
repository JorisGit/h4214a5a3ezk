<?php
function recupDepartement(){
        
        global $BDD;
        
        $requete = $BDD->query("SELECT * FROM departement");
        return $requete;
}

function Recherche($sport,$sexe,$ageMini,$ageMax,$departement, $dispo) {
    
    global $BDD;
    
    $sports = array('tennis', 'ping_pong', 'boxe', 'badminton', 'footing', 'velo', 'kayak', 'escalade', 'squash', 'natation', 'equitation', 'escrime');

    $sql = 'SELECT * FROM profils WHERE etat = 1 AND visibilite = \'visible\'';
    
    if($sexe == 'Les deux')
        $sql .= ' AND sexe IN (\'Homme\', \'Femme\')';
    else
        $sql .= ' AND sexe = :sexe';
    
    if(empty($ageMini) && !empty($ageMax))
        $sql .= ' AND age <= :ageMax';
    elseif(empty($ageMax) && !empty($ageMini))
        $sql .= ' AND age >= :ageMini';
    elseif(!empty($ageMini) && !empty($ageMax))
        $sql .= ' AND age BETWEEN :ageMini AND :ageMax';

    if(!empty($departement)) {
        if(substr($departement, 0, 2) == '97')
            $sql .= ' AND SUBSTR(code_postal, 1, 3) = :departement';
        else
            $sql .= ' AND SUBSTR(code_postal, 1, 2) = :departement';
    }

    for($i = 0; $i < count($dispo); $i++) {
        if($i == 0) {
            $sql .= ' AND ('.$dispo[$i].' = 1';
            if(count($dispo) == 1)
                $sql.= ')';
        }
        elseif($i + 1 < count($dispo))
            $sql .= ' OR '.$dispo[$i].' = 1';
        else
            $sql .= ' OR '.$dispo[$i].' = 1)';
    }
    
    for($i = 0; $i < count($sports); $i++) {
        if($sport == $sports[$i])
            $sql .= ' AND '.$sports[$i].' = 1 ORDER BY pseudo';
    }
    
    $req = $BDD->prepare($sql);

    if(!empty($departement))
        $req->bindParam(':departement', $departement, PDO::PARAM_INT);
    
    if(!empty($ageMax) && !empty($ageMini)) {
        $req->bindParam(':ageMini', $ageMini, PDO::PARAM_INT);
        $req->bindParam(':ageMax', $ageMax, PDO::PARAM_INT);
    } elseif(empty($ageMax) && !empty($ageMini))
        $req->bindParam(':ageMini', $ageMini, PDO::PARAM_INT);
    elseif(empty($ageMini) && !empty($ageMax))
        $req->bindParam(':ageMax', $ageMax, PDO::PARAM_INT);
    
    if($sexe != 'Les deux')
        $req->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    
    $req->execute();
    
    return $req;
    
}

function convertCPVille($code_postal) {
    global $BDD;
    
    if(substr($code_postal, 0, 2) == '75')
        return 'Paris';
    
    $req = $BDD->prepare('SELECT * FROM villes_france WHERE ville_code_postal = ?');
    $req->execute(array($code_postal));
    
    $data = $req->fetch();
    
    return $data['ville_nom_reel'];
}

function detectDepart($code_postal) {
    global $BDD;
    
    if(substr($code_postal, 0, 2) == '97') {
        $departement = substr($code_postal, 0, 3);
    } else {
        $departement = substr($code_postal, 0, 2);
    } return $departement;
}

?>