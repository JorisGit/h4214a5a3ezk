<!DOCTYPE html>
<html lang="fr">
	<?php
        include 'elt/head.php';
    ?>
	<body>
        <?php
            include 'elt/header.php';
        ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div id="container">    
            <h1>Inscription</h1>
            <?php echo ($erreur); echo ($message);?>
            <div class="clean"></div>
            <form name="inscription" onSubmit="return validate();" action="index.php?p=<?php echo $p;?>" method="post" class="formit" autocomplete="off" onsubmit="validate();">
                <div class="wrapperform">
                    <fieldset class="deuxfieldset">
                        <legend>Informations personnel</legend>
                        <ul>
                            <li><input type="text" required="true" name="nom" placeholder="Nom" id="nom" <?php if(isset($nom)) { echo 'value="'.$nom.'"'; }  ?>/></li>
                            <li><input type="text" required="true" name="prenom" placeholder="Prénom"  id="prenom "<?php if(isset($prenom)) { echo 'value="'.$prenom.'"'; }  ?>/></li>
                            <li>
                                <select name="sexe" required="true" id="sexe">
                                    <option value="">Sexe</option>
                                    <option <?php if(isset($sexe) && $sexe == 'Femme') { echo 'selected'; }?> >Femme</option>
                                    <option <?php if(isset($sexe) && $sexe == 'Homme') { echo 'selected'; }?> >Homme</option>
                                </select>
                            </li>
                            <li><input type="tel" name="telPortable" required="true" placeholder="Numéro de téléphone (portable)" id="telPortable" maxlength="12" <?php if(isset($telPortable)) { echo 'value="'.$telPortable.'"'; } ?> /></li>
                            <li><input type="text" pattern="[0-9]{5}" name="codePostal" required="true" id="codePostal" placeholder="Code postal" min="0" max="99999"  oninput="maxLengthCheck(this)" maxlength="5" <?php if(isset($codePostal)) { echo 'value="'.$codePostal.'"'; } ?> /></li>
                            <li><h3>Date de naissance</h3></li>
                            <li class="flex"><input pattern="[0-9]{2}" type="text" required="true" name="jourNaissance" placeholder="JJ" class="inputdm" <?php if(isset($jourNaissance)) { echo 'value="'.$jourNaissance.'"'; } ?> oninput="maxLengthCheck(this)" maxlength="2" /><input pattern="[0-9]{2}" type="text" required="true" name="moisNaissance" placeholder="MM" class="inputdm" <?php if(isset($moisNaissance)) { echo 'value="'.$moisNaissance.'"'; } ?> oninput="maxLengthCheck(this)" maxlength="2" /><input pattern="[0-9]{4}" type="text" required="true" name="anneeNaissance" placeholder="YYYY" class="inputy" oninput="maxLengthCheck(this)" maxlength="4" <?php if(isset($anneeNaissance)) { echo 'value="'.$anneeNaissance.'"'; } ?> /></li>
                        </ul>
                    </fieldset>
                    <fieldset class="deuxfieldset">
                        <legend>Informations de compte</legend>
                        <ul>
                            <li><input type="text" name="pseudo" required="true" placeholder="Pseudo" <?php if(isset($pseudo)) { echo 'value="'.$pseudo.'"'; } ?> /></li>
                            <li><input type="email" name="email" id="email" required="true" placeholder="Email" <?php if(isset($email)) { echo 'value="'.$email.'"'; } ?> /></li>
                            <li><input type="email" name="email2" id="email2" required="true" placeholder="Confirmation email" <?php if(isset($email2)) { echo 'value="'.$email2.'"'; } ?>/></li>
                            <li><input type="password" name="mdp" id="mdp" required="true" placeholder="Mot de passe" /></li>
                            <li><input type="password"  required="true" id="mdp2" name="mdp2" placeholder="Confirmation mot de passe"  /></li>
                        </ul>
                    </fieldset>
                </div>
                <div class="wrapperform">
                    <fieldset class="unfieldset">
                        <legend>Inscription</legend>
                        <div class="deuxpart">
                            <ul>
                                <li><input type="checkbox" name="newsletter" value="newsletter" id="newsletter" /><label for="newsletter" class="chkboxlab">Je souhaite être informer sur l'actualité et les évolutions du site (Newsletter)</label></li>
                                <li><input type="checkbox" name="conditiongenerale"  required="true" value="conditiongenerale" id="conditiongenerale" <?php if(isset($conditiongenerale)) { echo 'checked'; } ?> /><label for="conditiongenerale" class="chkboxlab">J'ai lu et j'accepte les Conditions Générales d'utilisation (CGU)*</label></li>
                                <div class="g-recaptcha" data-sitekey="6Lf0lQkUAAAAAJQhBc-7LrGNUXyq6Al_xkNqzbvb"></div>
                                <br />
                            </ul>
                        </div>
                        <div class="poscenterbtn" style="margin-top:20px;">
                            <input type="submit" name="valider" id="valider" value="S'inscrire"/>   
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
        <?php
            include 'elt/footer.php';
        ?>
        <?php
            if(isset($msgAlert)) {
        ?>
        <script>
            alert('Votre inscription a été effectué, merci de vérifiez votre boite mail pour vérifier votre compte.');
        </script>
        <?php
            }
        ?>
        <script src="js/fctform.js"></script>
	</body>
</html>
