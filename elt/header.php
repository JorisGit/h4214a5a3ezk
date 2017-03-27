<header>
    <div class="wrapper">
        <img src="images/mini-logo.png" class="logo" alt="logo" />
        <!--<h1>Maison <span class="orange">des</span> Ligues</h1> -->
        <nav>
            <ul>
				<li><a href="index.php?p=<?php echo $accueil ?>" <?php if($p == $accueil) { ?> class="orange" <?php } ?>>Accueil</a></li>
                <?php
                if(isset($_SESSION["email"])) {
                ?>
                <li><a href="index.php?p=<?php echo $monProfil; ?>" <?php if($p == $monProfil) { ?> class="orange" <?php } ?>>Mon profil</a></li>
                <li><a href="index.php?p=<?php echo $rencontre; ?>" <?php if($p == $rencontre) { ?> class="orange" <?php } ?>>Rencontre</a></li>
                <li><a href="index.php?p=<?php echo $deconnexion; ?>">Déconnexion</a></li>
                <?php
                } else {
                ?>
                <li><a href="index.php?p=<?php echo $connexion; ?>" <?php if($p == $connexion) { ?> class="orange" <?php } ?>>Connexion</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>		
    </div>
</header>