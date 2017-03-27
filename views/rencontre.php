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
            <h1>Recherchez <span class="orange">votre partenaire</span> de sport</h1>
            <div class="cadre">
                <div id="recherche">
                    <form name="recherche" onsubmit="return validate();" action="index.php?p=<?php echo $p;?>" method="post" class="formit" autocomplete="off">
                        <h3>Critères</h3>
                        <ul id="rechercheform">
                            <li>
                               <ul>
                                    <li>
                                        <select name="sport" size="1">
                                            <option value="">Sport</option>
                                            <option <?php if(isset($sport) && $sport == 'tennis') { echo 'selected'; }?>>Tennis</option>
                                            <option <?php if(isset($sport) && $sport == 'ping_pong') { echo 'selected'; }?> value="ping_pong">Ping-Pong</option>
                                            <option <?php if(isset($sport) && $sport == 'footing') { echo 'selected'; }?>>Footing</option>
                                            <option <?php if(isset($sport) && $sport == 'badminton') { echo 'selected'; }?>>Badminton</option>
                                            <option <?php if(isset($sport) && $sport == 'boxe') { echo 'selected'; }?>>Boxe</option>
                                            <option <?php if(isset($sport) && $sport == 'velo') { echo 'selected'; }?>>Velo</option>
                                            <option <?php if(isset($sport) && $sport == 'kayak') { echo 'selected'; }?>>Kayak</option>
                                            <option <?php if(isset($sport) && $sport == 'escalade') { echo 'selected'; }?>>Escalade</option>
                                            <option <?php if(isset($sport) && $sport == 'squash') { echo 'selected'; }?>>Squash</option>
                                            <option <?php if(isset($sport) && $sport == 'natation') { echo 'selected'; }?>>Natation</option>
                                            <option <?php if(isset($sport) && $sport == 'equitation') { echo 'selected'; }?>>Equitation</option>
                                            <option <?php if(isset($sport) && $sport == 'escrime') { echo 'selected'; }?>>Escrime</option>
                                        </select>
                                    </li>
                                    <li>
                                         <select name="sexe" size="1">
                                             <option value="Les deux" <?php if(isset($sexe) && $sexe == 'Les deux') { echo 'selected'; }?>>Sexe</option>
                                             <option <?php if(isset($sexe) && $sexe == 'Homme') { echo 'selected'; }?>>Homme</option>
                                             <option <?php if(isset($sexe) && $sexe == 'Femme') { echo 'selected'; }?>>Femme</option>
                                         </select>
                                    </li>
                               </ul>
                            </li>
                            <li><h3>Tranche d'âge</h3></li>
                            <li>
                               <ul>
                                    <li>
                                            <select name="ageMini" size="1">
                                            <option value="">Age minimum</option>
                                    <?php 
                                        for($i = 15; $i <= 80; $i++) {
                                    ?>
                                            <option <?php if(isset($ageMini) && $ageMini == $i) { echo 'selected'; }?>><?php echo $i;?></option>
                                    <?php 
                                        }
                                    ?>
                                        </select>
                                    </li>
                                    <li>
                                        <select name="ageMax" size="1">
                                            <option value="">Age maximum</option>
                                        <?php 
                                        for($i = 80; $i >= 18; $i--) {
                                    ?>
                                            <option <?php if(isset($ageMax) && $ageMax == $i) { echo 'selected'; }?>><?php echo $i;?></option>
                                        <?php 
                                        }
                                    ?>
                                        </select>
                                    </li>
                               </ul>
                            </li>
                            <li><h3>Localisation</h3></li>
                            <li>
                                <select name="departement" size="1">
                                    <option value="">Département</option>
                                <?php 
                                     while($recup = $recupDep->fetch()) {
                                         $codeDep = $recup['departement_code'];
                                         $nomDep = $recup['departement_nom'];
                                         
                                         if(isset($departement) && substr($departement, 0, 3) == substr($codeDep, 0, 3)) {
                                ?>
                                            <option selected><?php echo $codeDep.' - '.$nomDep; ?></option>
                                <?php
                                         } else {
                                ?>
                                            <option><?php echo $codeDep.' - '.$nomDep; ?></option>
                                <?php
                                        }
                                     }
                                ?>
                                </select>
                            </li>
                        </ul>
                        <h3>Disponibilité</h3>
                        <ul id="disponibilite">
                            <li><input type="checkbox" name="lundi" id="lundi" <?php if(isset($lundi)) { echo 'checked'; } ?> /><label for="lundi">Lundi</label></li>
                            <li><input type="checkbox" name="mardi" id="mardi" <?php if(isset($mardi)) { echo 'checked'; } ?> /><label for="mardi">Mardi</label></li>
                            <li><input type="checkbox" name="mercredi" id="mercredi" <?php if(isset($mercredi)) { echo 'checked'; } ?> /><label for="mercredi">Mercredi</label></li>
                            <li><input type="checkbox" name="jeudi" id="jeudi" <?php if(isset($jeudi)) { echo 'checked'; } ?> /><label for="jeudi">Jeudi</label></li>
                            <li><input type="checkbox" name="vendredi" id="vendredi" <?php if(isset($vendredi)) { echo 'checked'; } ?> /><label for="vendredi">Vendredi</label></li>
                            <li><input type="checkbox" name="samedi" id="samedi" <?php if(isset($samedi)) { echo 'checked'; } ?> /><label for="samedi">Samedi</label></li>
                            <li><input type="checkbox" name="dimanche" id="dimanche" <?php if(isset($dimanche)) { echo 'checked'; } ?> /><label for="dimanche">Dimanche</label></li>
                        </ul>
                        <div class="poscenterbtn" style="margin-top:20px;">
                            <input type="submit" name="filtre" id="valider" value="Rechercher"/>   
                        </div>
                    </form>
                </div>
            </div>
            <div id="affichage">
            <?php
            if(isset($_POST['filtre'])) {

                $liste_profil = Recherche($sport,$sexe,$ageMini,$ageMax,$departement, $dispo);
                $nbResult = 0;
                while($data = $liste_profil->fetch()) {
            ?>
                <div class="displayprofil">
                    <h4><?php echo $data['pseudo']; ?></h4>
                    <img src="images/membres/avatar/<?php echo $data['avatar']; ?>" />
                    <ul class="general">
                        <li>
                            <ul class="catprof">
                                <li>Sexe</li>
                                <li>Nom</li>
                                <li>Prénom</li>
                                <li>Age</li>
                                <li>Département</li>
                                <li>Ville</li>
                            </ul>
                        </li>
                        <li>
                            <ul class="dataprof">
                                <li><?php echo $data['sexe']; ?></li>
                                <li><?php echo $data['nom']; ?></li>
                                <li><?php echo $data['prenom']; ?></li>
                                <li><?php echo $data['age']; ?></li>
                                <li><?php echo detectDepart($data['code_postal']); ?></li>
                                <li><?php echo convertCPVille($data['code_postal']); ?></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="dispodisplay">
                        <li <?php if($data['lundi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Lun.</li>
                        <li <?php if($data['mardi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Mar.</li>
                        <li <?php if($data['mercredi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Mer.</li>
                        <li <?php if($data['jeudi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Jeu.</li>
                        <li <?php if($data['vendredi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Ven.</li>
                        <li <?php if($data['samedi'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Sam.</li>
                        <li <?php if($data['dimanche'] == 1) echo 'class="caseok"'; else echo 'class="nocase"'; ?>>Dim.</li>
                    </ul>
                </div>
            <?php
                    $nbResult++;
                }
                if($nbResult == 0) {
            ?>
                <p>Aucun résultat correspond à vos critères de recherches.</p>
            <?php
                }
            } else {
            ?>
                <p>Veuillez utiliser le filtre pour rechercher des profils correspondant à vos attentes.</p>
            <?php
            }
            ?>
            </div>
            <?php
            if($nbResult > 0)
            ?>
            <p style="margin: auto; text-align: center;"><?php echo $nbResult; ?> profil<?php if($nbResult != 1) echo 's ont été trouvés'; else echo ' a été trouvé'; ?>.</p>
        </div>
        <?php
            include 'elt/footer.php';
        ?>
    </body>
</html>