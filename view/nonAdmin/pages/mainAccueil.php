<main class="mainAccueil">

	<div id="presentation" >
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></h2>
		<div id="tableaupresentation">
			<div id="colonnegauche">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto1'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto2'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto3'); ?>">
			</div>
			<div id="colonnecentrale">
				<?php echo htmlspecialchars_decode($page->get('contenu1')); ?>

			</div>
			<div id="colonnedroite">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto4'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto5'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto6'); ?>">
			</div>
		</div>
	</div>

	<div id="coordonnees">
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre2')); ?></h2>
		<?php echo htmlspecialchars_decode($page->get('contenu2')); ?>
		<!--
		<ul>
		    <li>adresse postale : « la ferme du père Boyer », les prés grands, Choriol, 63950 Saint-Sauves d’Auvergne.</li>
		    <li>courriel : contact@lafermedupereboyer.fr</li>
		    <li>téléphone mobile : 06 83 47 23 21</li>
		    <li>coordonnées GPS : Latitude : 45°36'53.2'N | Longitude : 2°40'15.3'E  ou bien  Latitude : 45.614778 | Longitude : 2.670917</li>
		</ul>
		-->
	</div>
	
	<div id="carte">
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre3')); ?></h2>
		<?php echo htmlspecialchars_decode($page->get('contenu3')); ?>
		<img src="img/pictos/pictoPB.png" style="width:200px;">
		<br>
		<br>
		<!--
		<p>
			A 4 h 30 de paris, 2 h de Lyon, 3 h de Bordeaux, 3 h 30 de Toulouse, 3 h d’Orléans, par la sortie d’autoroute A 89 (Saint-Julien Puy-Lavèze, sortie n° 25), la Ferme du Père Boyer vous accueille, au coeur de l'Auvergne bla bla bla.
		</p>
		<br>
		-->
		<center>
			<iframe id="iframeCarte" src="https://www.google.com/maps/d/embed?mid=1_5Uhl9tYqzBmfyALHc_3xELopLo" width="800" height="600"></iframe>
		</center>
		<br>
	</div>

	<!--<div id="logos">
		<center>
			<img class="leslogos" src="img/logos/logo-GDF-3epis.png">
			<img class="leslogos" src="img/logos/nattitude.png">
			<img class="leslogos" src="img/logos/Label-tourisme-et-handicap.png">
			<img class="leslogos" src="img/logos/parc.png">
			<img class="leslogos" src="img/logos/index.jpeg">
			<img class="leslogos" src="img/logos/region.png">
		</center>
	</div>-->
		
	<div id="contact">
		<h3 class="titre" >Contact</h3>
		<hr>
		<br><br>
		<form id="formulaireContact" action="index.php" method="post">
			<fieldset>
				<!--<input type="hidden" name="action" value="traiterMessage">-->
				<input type="hidden" name="action" value="loadAccueil">
				<input type="hidden" name="message" value="message">
				<!--<legend></legend>-->
				<p class="ligneFormulaire">
					<label class="labelFormulaire" for="nom_id">Nom</label>
					<input type="text" name="nom" id="nom_id" required/>
				</p>
				<p class="ligneFormulaire">
					<label class="labelFormulaire" for="prenom_id">Prénom</label>
					<input type="text" name="prenom" id="prenom_id" required/>
				</p>
				<p class="ligneFormulaire">
					<label class="labelFormulaire" for="email_id">email</label>
					<input type="email" name="email" id="eamil_id" required/>
				</p>
				<p class="ligneFormulaire">
					<label class="labelFormulaire" for="telephone_id">téléphone</label>
					<input type="text" name="telephone" id="telephone_id" required/>
				</p>
				<p class="ligneFormulaire">
					<label class="labelFormulaire" for="message_id">votre message</label>
				</p>
				<p class="ligneFormulaire">
					<textarea name="message" rows="4" cols="60" placeholder="écrivez votre message ici."></textarea>
				</p>
				<p class="ligneFormulaire">
					<input style="color:black;margin-top:1em;margin-bottom:2em;" type="button" name="envoyer" value="envoyer le message" onclick="envoyerMessage();">
				</p>
			</fieldset>
		</form>
	</div>

	
	

</main>
