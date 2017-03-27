<?php
$erreur = "";
$message = "";

require 'models/inscription.php';
require('models/recaptcha/autoload.php');

if(isset($_POST['valider'])) {
    
    //reCaptcha
    $recaptcha = new \ReCaptcha\ReCaptcha('6Lf0lQkUAAAAAHexSkmK8F1AxKje36n6UPnAGkRe');
    $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
    
    //Informations personnel
    $nom = htmlspecialchars(ucfirst(strtolower($_POST['nom'])));
    $prenom = htmlspecialchars(ucfirst(strtolower($_POST['prenom'])));
    $telPortable = htmlspecialchars($_POST['telPortable']);
    $codePostal = htmlspecialchars($_POST['codePostal']);
    $jourNaissance = htmlspecialchars($_POST['jourNaissance']);
    $moisNaissance = htmlspecialchars($_POST['moisNaissance']);
    $anneeNaissance = htmlspecialchars($_POST['anneeNaissance']);
    $sexe = $_POST['sexe'];
    
    $dateNaissance = $jourNaissance.'/'.$moisNaissance.'/'.$anneeNaissance;
    
    $age = calculAge($dateNaissance);
    
    //Informations de compte
    $pseudo = htmlspecialchars(ucfirst(strtolower($_POST['pseudo'])));
    $email = htmlspecialchars(strtolower($_POST['email']));
    $email2 = htmlspecialchars(strtolower($_POST['email2']));
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    
    if($pseudo != "" && $mdp != "" && $resp->isSuccess()) {
         $exist = utilisateurExists($pseudo);
        if($exist == false) { 
            $exist2 = emailExists($email);
            
            if($exist2 == false){
                
                $longueurKey = 15;
                $key= "";
                for($i=1;$i<$longueurKey;$i++){
                    $key .= mt_rand(0,9);
                }
                $inscription = inscriptionUtilisateur($nom,$prenom,$sexe, $telPortable, $codePostal, $dateNaissance, $pseudo, $email, $mdp, $key, $age);
                if($inscription == true){
                    header('refresh: 5; index.php?p=connexion');
                    $msgAlert = true;
                }
            } else {
                $erreur = "Cette adresse mail est déjà utilisé";
            }
        } else {
            $erreur = "Ce pseudo existe deja.";
        }
    } else {
        $erreur = "Le captcha est invalide.";
    }
    
    //Inscription
    if(isset($_POST['conditiongenerale'])) {
        $conditiongenerale = $_POST['conditiongenerale'];
    }
    if(isset($_POST['newsletter'])) {
        $newsletter = $_POST['newsletter'];
    } 
}

include 'views/inscription.php';

?>