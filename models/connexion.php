<?php
function verifUser($email, $password){
    
    $password = sha1($password);
    
    global $BDD;
    
    $req = $BDD->prepare("SELECT * from profils where email = ? AND password = ?");
    $req->execute(array($email, $password));
    $res = $req->rowCount();
    
    if($res == 1){
        return true;
    } else{
        return false;
    }
}

function mailConfirm($email) {
    
    global $BDD;
    
    $req = $BDD->prepare('SELECT * FROM profils WHERE email = ?');
    $req->execute(array($email));
    
    $data = $req->fetch();
    
    if ($data['etat'] == 1)
        return true;
    else
        return false;
}

function dataUser($email) {
    
    global $BDD;
    
    $req = $BDD->prepare('SELECT * FROM profils WHERE email = ?');
    $req->execute(array($email));
    
    $data = $req->fetch();
    
    return $data;
}
?>