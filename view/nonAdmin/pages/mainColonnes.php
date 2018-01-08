<main class="mainAccueil">
	<div id="presentation">
		<div class="titre"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></div>
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
</main>
