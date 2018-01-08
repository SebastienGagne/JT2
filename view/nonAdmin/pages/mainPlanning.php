<main class="mainAccueil">
	<form id="formReserver" name="demande" action="index.php" method="post">
		<div class="formulaireDemande">
			<h2>Planning du gîte <?php echo $tabNomsGites[$gite]; ?></h2>
			<p>en rouge, les dates déjà réservées.</p>
			<p>en bleu, les dates encore libres.</p>
			<?php echo $cal['entete_non_admin']; ?>
			<?php echo $cal['affichage']; ?>

			<input type="hidden" name="gite" value="<?php echo $gite; ?>">
			<input type="hidden" name="action" value="loadAccueil">
			<input type="hidden" name="demande" value="demande">
			<h3>Complétez le formulaire pour envoyer votre demande de réservation</h3>
			<?php echo $form; ?>
			<input style="color:black;margin-top:1em;margin-bottom:2em;" type="button" name="envoyer" value="envoyer la demande" onclick="envoyerDemande();">
		</div>
	</form>
</main>