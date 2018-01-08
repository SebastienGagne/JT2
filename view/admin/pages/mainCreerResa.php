<main style="margin:0px 20px 0px 20px;">
	<form id="formReserver" name="demande" action="index.php?controller=reservation&action=creerResa&gite=<?php echo $gite; ?>" method="post">
		<h2>Planning du gîte <?php echo $gite; ?></h2>
		<?php echo $cal['entete_creerResa']; ?>
		<?php echo $cal['affichage']; ?>
		<input type="hidden" name="demande" value="demande">
		<input type="hidden" name="gite" value="<?php echo $gite; ?>">
		<div class="formulaireDemandeAdmin">
			<h3>Complétez le formulaire pour créer la réservation </h3>
			<?php echo $form; ?>
			<input style="color:black;margin-top:9em;margin-bottom:2em;" type="button" name="envoyer" value="envoyer la demande" onclick="envoyerDemande();">
		</div>
	</form>
</main>