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
		<?php 
		if (($affichage_resa != "") && ((int)substr($jour, 5, 2) == $mois)) {
			echo $affichage_resa;
			echo "<input type='submit' name='deleteDay' value='supprimer la nuitée du ".$jour."'>";
			echo "<input type='submit' name='deleteResa' value='supprimer la résa entière'>";
		}
		?>
		<!--<input type="submit" name="deleteDay" value="supprimer la nuitée du <?php echo $jour; ?>">
		<input type="submit" name="deleteResa" value="supprimer la résa entière">-->
	</form>
</main>