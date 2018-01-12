<main style="margin:0px 20px 0px 20px;">
	<form id="formReserver" name="demande" action="index.php?controller=reservation&action=gererDemandes&gite=<?php echo $gite; ?>" method="post">
		<h2>Planning du gîte <?php echo $gite; ?></h2>
		<?php echo $cal['entete_creerResa']; ?>
		<?php echo $cal['affichage']; ?>
		<input type="hidden" name="demandeModif" value="demandeModif">
		<input type="hidden" name="gite" value="<?php echo $gite; ?>">
		<input type="hidden" name="id" value="<?php echo $resa['id']; ?>">
		<div class="formulaireDemandeAdmin">
			<h3>Modifiez les champs du formulaire et validez </h3>
			<?php echo $form; ?>
			<input style="color:black;margin-top:9em;margin-bottom:2em;" type="button" name="envoyer" value="envoyer la demande" onclick="envoyerDemande();">
		</div>
	</form>
</main>