<?php

include("PHPMailer-master/class.phpmailer.php");
include("PHPMailer-master/class.smtp.php");
include('recaptcha/autoload.php');
date_default_timezone_set("Europe/Paris");

function reCaptchaVerif($resp,$recaptcha){
    
    $recaptcha = new \ReCaptcha\ReCaptcha('6LeXMQoUAAAAAHv7rCw8Tsb5mx64_qGedodiUqTT');
    $resp = $recaptcha->verify($_POST['g-recaptcha']);
    
    if ($resp->isSuccess()) {
        var_dump('captcha valide');
        return true;
    // Le captcha est validé par Google
    } else {
        var_dump('captcha invalide');
    $errors = $resp->getErrorCodes();
        var_dump($errors);
        return false;
    }
}

function calculAge($dateNaissance) {
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
    } return $age;
}

function utilisateurExists($pseudo){
    global $BDD;
    $sql = "SELECT pseudo FROM profils WHERE pseudo = ?";
    
    $requete = $BDD->prepare($sql);
    $requete->execute(array($pseudo));
    $compteur = $requete->rowCount();
    
    if ($compteur >= 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function emailExists($email){
    global $BDD;
    $sql2 = "SELECT email FROM profils WHERE email = ?";
    
    $requete2 = $BDD->prepare($sql2);
    $requete2->execute(array($email));
    $compteur2 = $requete2->rowCount();
    
    if($compteur2 >= 1){
        return true;
    } else{
        
        return false;
    }
}

function inscriptionUtilisateur($nom,$prenom,$sexe, $telPortable, $codePostal, $datenaissance, $pseudo, $email, $mdp,$key, $age){
    global $BDD;
    $sql3 = "INSERT INTO profils (nom,prenom,sexe,portable,code_postal,date_naissance,pseudo,email,password,confirmkey,etat,age) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $requete3 = $BDD->prepare($sql3);
    $requete3->execute(array($nom,$prenom,$sexe, $telPortable, $codePostal, $datenaissance, $pseudo, $email, $mdp,$key,0,$age));
    
    $mail = new PHPMailer();
 
    $body = '<a href="http://sospartner.behind-shop.fr/sos/index.php?p=validation&pseudo='. urlencode($pseudo) .'&key='.$key.'">Confirmez votre compte!</a>';

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.free.fr";  
    $mail->Port = 587;             

    $mail->Username = "m2ljoris@free.fr";
    $mail->Password = "sospartner";        
    $mail->From = "nepasrepondre@m2l.fr"; //adresse d’envoi correspondant au login entrée précédement
    $mail->FromName = "Maison des ligues"; // nom qui sera affiché
    $mail->Subject = "Confirmation d'inscription"; // sujet
    $mail->AltBody = "Bienvenue!"; //Body au format texte

    $mail->WordWrap = 50; // nombre de caractere pour le retour a la ligne automatique
    $mail->MsgHTML($body);

    $mail->AddReplyTo("nepasrepondre@m2l.fr","Maison des ligues");
    $mail->AddAttachment("PHPMailer-master/examples/images/phpmailer.png");             // piéce jointe si besoin
    $mail->AddAddress($email);
    $mail->IsHTML(true); // envoyer au format html, passer a false si en mode texte

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      $nptk = "Le message à bien été envoyé";
    }
    
    return true;
}

?>