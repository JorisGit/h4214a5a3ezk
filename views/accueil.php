<!DOCTYPE html>
<html lang="fr">
	<?php
        include 'elt/head.php';
    ?>
	<body>
		<?php
            include 'elt/header.php';
        ?>

		<section id="main-image">
			<div class="wrapper">
				<h2>Retrouvez tous<br><strong>les meilleurs sports</strong></h2>
				<?php
                if(!isset($_SESSION['pseudo'])) { 
                ?>
				<a href="index.php?p=inscription" class="button-1">Inscrivez-vous</a>
                <?php
                }
                ?>
			</div>
		</section>


		
		<section id="welcome">
			<div class="wrapper">
			<h1>Bienvenue !</h1>	

			<p>La Maison des Ligues de Lorraine (M2L) a pour mission de fournir des espaces et des services aux différentes ligues sportives régionales de Lorraine et à d’autres structures hébergées. La M2L est une structure financée par le Conseil Régional de Lorraine dont l'administration est déléguée au Comité Régional Olympique et Sportif de Lorraine (CROSL).<br> Installée depuis 2003 dans la banlieue Nancéienne, la M2L accueille l'ensemble du mouvement sportif Lorrain qui représente près de 6 500 clubs, plus de 525 000 licenciés et près de 50 000 bénévoles.</p>
			</div>

			<div class="clear"></div>

		</section>


			<section id="articles">
				<div class="wrapper">
					<article style="background-image:url('images/taize-une-rencontre-franco-allemande-58505.jpg')">
						<div class="overlay">
							<h4>Session rencontre</h4>
							<p><small>Venez découvrir toute l'équipe de la Maison des Ligues</small></p>
							<a href="#" class="button-2">Plus d'infos</a>
						</div>
					</article>

					<article style="background-image:url('images/remise-diplome-DATR.jpg')">
						<div class="overlay">
							<h4>François a eu son BTS</h4>
							<p><small>Incroyable, un elève développant seulement avec du Python, a eu son BTS !</small></p>
							<a href="#" class="button-2">Plus d'infos</a>
						</div>
					</article>
				<div class="clear"></div>
				</div>
			
			</section>

			<section id="contactez-nous">
				<div class="wrapper">
				<h1>Newsletter</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et finibus libero. Proin pretium justo a ultrices placerat. Pellentesque id urna non diam accumsan venenatis ut eget nulla. Vivamus nec lectus eget ex lacinia sodales. Curabitur lacinia sem euismod lacinia malesuada. Aliquam ac maximus urna. Maecenas nec mi lectus. Aenean consectetur mauris et varius accumsan. Maecenas et tempor sapien. Cras pretium, risus sit amet fermentum pulvinar, magna enim posuere enim, eu interdum orci enim quis erat. Vivamus feugiat, ante nec posuere finibus, leo dolor euismod nisl, ac aliquam leo lorem mollis ipsum.</p>

				<form>
					<label for="name">Nom</label>
					<input type="text" id="name" placeholder="Votre nom">
					<label for="email">Email</label>
					<input type="text" id="email" placeholder="Votre email">
					<input type="submit" class="button-3" value="OK">
				</form>

				</div>

			</section>
        <?php
            include 'elt/footer.php';
        ?>
	</body>
</html>
