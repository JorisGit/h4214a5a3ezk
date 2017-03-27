<?php
function updateAge($dateNaissance, $pseudo) {
    $jourN = intval(substr($dateNaissance, 0, 2));
    $moisN = intval(substr($dateNaissance, -7, 2));
    $anneeN = intval(substr($dateNaissance, -4));
    
    $age = date('Y') - $anneeN;
    
    if ($moisN > date('m')) {
        $age--;
    } else if ($moisN == date('m')) {
        if ($jourN > date('d')) {
            $age--;
        }
    }
    
    global $BDD;
    
    $req = $BDD->prepare('UPDATE profils SET age = ? WHERE pseudo = ?');
    $req->execute(array($age, $pseudo));
}

function dataUser() {
    global $BDD;
        
    $req = $BDD->query('SELECT * FROM profils');
    
    return $req;
}
?>