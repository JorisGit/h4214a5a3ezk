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
           <div style="margin:auto; text-align: center; width:800px;">
            <?php
            if(isset($message)) {
            ?>
                    <p style="color: #444; font-weight: 400; margin-bottom: 300px; margin-top: 300px;"><?php echo $message.'<br/>'; if($message == "Votre compte a été vérifié") { echo 'Pour vous connecter, cliquer sur ce <a href="index.php?p=connexion" class="orange" style="font-weight: 800;">lien</a>'; } else { echo 'Pour revenir à l\'accueil, cliquer sur ce <a href="index.php?p=accueil" class="orange" style="font-weight: 800;">lien</a>'; }?></p>
            <?php
            }
            ?>
           </div>
        </div>
        <?php
            include 'elt/footer.php';
        ?>
    </body>
</html>