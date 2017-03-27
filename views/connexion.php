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
            <h1>Connexion</h1>
            <div class="clean"></div>
            <form name="connexion" onSubit="return validate();" action"index.php?p=connexion" method="post" class="formit" autocomplete="off" onSubmit="validate();">
                <div class="wrapperform">
                    <?php if(isset($message)) echo $message; ?>
                    <fieldset class="deuxfieldset">
                        <legend>Connexion</legend>
                        <ul>
                            <li><input type="text" required="true" name="email" placeholder="Email" id="email"/>
                            </li>
                            <li><input type="password" required="true" name="password" placeholder="Mot de passe" id="password"/>
                            </li>
                        </ul>
                        <div class="poscenterbtn" style="margin-top:20px;">
                            <input type="submit" name="connexion" value="Connexion"/>   
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
        <?php
            include 'elt/footer.php';
        ?>
    </body>
</html>