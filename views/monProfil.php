<!DOCTYPE html>
<html lang="fr">
    <?php
        include 'elt/head.php';
    ?>
    <body>
        <?php
            include 'elt/header.php';
        ?>
        <div id="container">
            <div class="wrapper">
                <div id="profil">
                    <h3>Mon <span class="orange">profil</span></h3>
                    <ul id="infoprof">
                        <li>
                            <ul id="info">
                                <li><?php echo afficherAvatar($_SESSION['pseudo']); ?></li>
                                <li>
                                    <ul class="cat">
                                        <li class="cat">Pseudo</li>
                                        <li class="cat">Sexe</li>
                                        <li class="cat">Nom</li>
                                        <li class="cat">Prénom</li>
                                        <li class="cat">Département</li>
                                        <li class="cat">Ville</li>
                                        <li class="cat">Statut du profil</li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="data">
                                        <li class="data"><?php echo recupInfos($_SESSION['pseudo'])['pseudo']; ?></li>
                                        <li class="data"><?php echo recupInfos($_SESSION['pseudo'])['sexe']; ?></li>
                                        <li class="data"><?php echo recupInfos($_SESSION['pseudo'])['nom']; ?></li>
                                        <li class="data"><?php echo recupInfos($_SESSION['pseudo'])['prenom']; ?></li>
                                        <li class="data"><?php echo detectDepart(recupInfos($_SESSION['pseudo'])['code_postal']); ?></li>
                                        <li class="data"><?php echo convertCPVille(recupInfos($_SESSION['pseudo'])['code_postal']); ?></li>
                                        <li class="data"><?php echo ucfirst(recupInfos($_SESSION['pseudo'])['visibilite']); ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                            <li><h4>Mes <span class="orange">sports</span></h4></li>
                            <li>
                                <ul id="datasports">
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['tennis'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Tennis</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['ping_pong'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Ping-pong</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['boxe'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Boxe</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['badminton'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Badminton</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['footing'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Footing</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['velo'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Vélo</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['kayak'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Kayak</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['escalade'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Escalade</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['squash'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Squash</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['natation'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Natation</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['equitation'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Equitation</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['escrime'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?> >Escrime</li>
                                </ul>
                            </li>
                            <li><h4>Mes <span class="orange">disponibilités</span></h4></li>
                            <li>
                                <ul id="dispo">
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['lundi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Lundi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['mardi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Mardi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['mercredi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Mercredi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['jeudi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Jeudi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['vendredi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Vendredi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['samedi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Samedi</li>
                                    <li <?php if(recupInfos($_SESSION['pseudo'])['dimanche'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Dimanche</li>
                                </ul>
                            </li>
                            </ul>
                        </li>
                    </ul>
                    <h3>Modifier/Définir <span class="orange">mon</span> profil</h3>
                    <form enctype="multipart/form-data" action="" method="post" autocomplete="off" class="formit">
                        <?php if(isset($message)) echo $message; ?>
                        <h4>Avatar</h4>
                        <input type="file" name="avatar" />
                        <h4>Mes <span class="orange">sports</span></h4>
                        <ul id="sports">
                            <li><input type="checkbox" name="tennis" id="tennis" <?php if(recupInfos($_SESSION['pseudo'])['tennis'] == 1) { echo 'checked'; } ?> /><label for="tennis">Tennis</label></li>
                            <li><input type="checkbox" name="pingpong" id="pingpong" <?php if(recupInfos($_SESSION['pseudo'])['ping_pong'] == 1) { echo 'checked'; } ?> /><label for="pingpong">Ping-Pong</label></li>
                            <li><input type="checkbox" name="boxe" id="boxe" <?php if(recupInfos($_SESSION['pseudo'])['boxe'] == 1) { echo 'checked'; } ?> /><label for="boxe">Boxe</label></li>
                            <li><input type="checkbox" name="badminton" id="badminton" <?php if(recupInfos($_SESSION['pseudo'])['badminton'] == 1) { echo 'checked'; } ?> /><label for="badminton">Badminton</label></li>
                            <li><input type="checkbox" name="footing" id="footing" <?php if(recupInfos($_SESSION['pseudo'])['footing'] == 1) { echo 'checked'; } ?> /><label for="footing">Footing</label></li>
                            <li><input type="checkbox" name="velo" id="velo" <?php if(recupInfos($_SESSION['pseudo'])['velo'] == 1) { echo 'checked'; } ?> /><label for="velo">Vélo</label></li>
                            <li><input type="checkbox" name="kayak" id="kayak" <?php if(recupInfos($_SESSION['pseudo'])['kayak'] == 1) { echo 'checked'; } ?> /><label for="kayak">Kayak</label></li>
                            <li><input type="checkbox" name="escalade" id="escalade" <?php if(recupInfos($_SESSION['pseudo'])['escalade'] == 1) { echo 'checked'; } ?> /><label for="escalade">Escalade</label></li>
                            <li><input type="checkbox" name="squash" id="squash" <?php if(recupInfos($_SESSION['pseudo'])['squash'] == 1) { echo 'checked'; } ?> /><label for="squash">Squash</label></li>
                            <li><input type="checkbox" name="natation" id="natation" <?php if(recupInfos($_SESSION['pseudo'])['natation'] == 1) { echo 'checked'; } ?> /><label for="natation">Natation</label></li>
                            <li><input type="checkbox" name="equitation" id="equitation" <?php if(recupInfos($_SESSION['pseudo'])['equitation'] == 1) { echo 'checked'; } ?> /><label for="equitation">Equitation</label></li>
                            <li><input type="checkbox" name="escrime" id="escrime" <?php if(recupInfos($_SESSION['pseudo'])['escrime'] == 1) { echo 'checked'; } ?> /><label for="escrime">Escrime</label></li>
                        </ul>
                        <h4>Mes <span class="orange">disponibiltés</span></h4>
                        <ul id="disponibilite">
                            <li><input type="checkbox" name="lundi" id="lundi" <?php if(recupInfos($_SESSION['pseudo'])['lundi'] == 1) { echo 'checked'; } ?> /><label for="lundi">Lundi</label></li>
                            <li><input type="checkbox" name="mardi" id="mardi" <?php if(recupInfos($_SESSION['pseudo'])['mardi'] == 1) { echo 'checked'; } ?> /><label for="mardi">Mardi</label></li>
                            <li><input type="checkbox" name="mercredi" id="mercredi" <?php if(recupInfos($_SESSION['pseudo'])['mercredi'] == 1) { echo 'checked'; } ?> /><label for="mercredi">Mercredi</label></li>
                            <li><input type="checkbox" name="jeudi" id="jeudi" <?php if(recupInfos($_SESSION['pseudo'])['jeudi'] == 1) { echo 'checked'; } ?> /><label for="jeudi">Jeudi</label></li>
                            <li><input type="checkbox" name="vendredi" id="vendredi" <?php if(recupInfos($_SESSION['pseudo'])['vendredi'] == 1) { echo 'checked'; } ?> /><label for="vendredi">Vendredi</label></li>
                            <li><input type="checkbox" name="samedi" id="samedi" <?php if(recupInfos($_SESSION['pseudo'])['samedi'] == 1) { echo 'checked'; } ?> /><label for="samedi">Samedi</label></li>
                            <li><input type="checkbox" name="dimanche" id="dimanche" <?php if(recupInfos($_SESSION['pseudo'])['dimanche'] == 1) { echo 'checked'; } ?> /><label for="dimanche">Dimanche</label></li>
                        </ul>
                        <h4>Visibilité <span class="orange">du</span> profil</h4>
                        <ul id="radio">
                            <li><input type="radio" name="visibilite" value="visible" id="visible" <?php if(recupInfos($_SESSION['pseudo'])['visibilite'] == 'visible') echo 'checked'; ?>><label for="visible">Visible</label></li>
                            <li><input type="radio" name="visibilite" value="invisible" id="invisible" <?php if(recupInfos($_SESSION['pseudo'])['visibilite'] == 'invisible') echo 'checked'; ?>><label for="invisible">Invisible</label></li>
                        </ul>
                        <input type="submit" value="Modifier" name="modif" />
                    </form>
                    <h3>Paramétrer <span class="orange">mon</span> profil</h3>
                    <form action="" method="post" autocomplete="off" class="formit">
                        <ul id="parametre">
                            <li><h4>Modifier <span class="orange">mon mot de</span> passe</h4></li>
                            <li><input type="password" name="mdp" placeholder="Nouveau mot de passe" /></li>
                            <li><input type="password" name="mdp2" placeholder="Confirmer nouveau mot de passe" /></li>
                            <li><h4>Supprimer <span class="orange">mon</span> compte</h4></li>
                            <li><input type="checkbox" name="delete" id="delete"><label for="delete">Supprimer mon compte définitivement</label></li>
                            <li><h4>Confirmer <span class="orange">les</span> changements</h4></li>
                            <li><input type="password" name="verif" placeholder="Mot de passe de vérification" /></li>
                            <li><input type="submit" name="apply" value="Appliquer"/></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include 'elt/footer.php';
        ?>
    </body>
</html>