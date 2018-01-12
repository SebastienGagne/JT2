<main style="margin:0px 20px 0px 20px;">
	<form id="modifResa" name="modif" action="index.php?controller=reservation&action=gererDemandes&mois=<?php echo $mois; ?>&an=<?php echo $an; ?>&gite=<?php echo $gite; ?>&jour=<?php echo $jour; ?>" method="post">
		<h2>Planning du gîte <?php echo $gite; ?></h2>
		<?php echo $cal['entete_editerResa']; ?>
		<?php echo $cal['affichage']; ?>
		<input type="hidden" name="demande" value="demande">
		<input type="hidden" name="jour" value="<?php echo $jour; ?>">
		<input type="hidden" name="id" value="<?php echo $resa['id']; ?>">
		<input type="hidden" name="gite" value="<?php echo $gite; ?>">
		<br>
		<?php echo $affichage_resa; ?>
		<?php echo $boutons_resa; ?>
	</form>
</main>