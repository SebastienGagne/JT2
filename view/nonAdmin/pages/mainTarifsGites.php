<style type="text/css">
	table {
		width:90%;
		margin-left:5%;
		margin-top:2em;
		border:1px solid white;
	}
	td, th {
		line-height: 2em;
		text-align: center;
		width: 24%;
		font-size: 1.5em;
		border:1px solid white;
	}
	th, td{
		background-color: black;
	}
</style>

<main class="mainAccueil">
	
	<div id="presentation">
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></h2>
		<div id="tableaupresentation">
			<div id="colonnegauche">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto1'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto2'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto3'); ?>">
			</div>
			<div id="colonnecentrale">
				<?php echo htmlspecialchars_decode($page->get('contenu1')); ?>
				<table>
					<tr>
						<th>gîte</th>
						<th>basse saison</th>
						<th>moyenne saison</th>
						<th>haute saison</th>
					</tr>
					<?php 
						foreach ($tarifGites as $i => $tabGite) {
							$ligne  = "<td>".$tabGite['gite']."</td>";
							$ligne .= "<td>".$tabGite['tarifBS']." €</td>";
							$ligne .= "<td>".$tabGite['tarifMS']." €</td>";
							$ligne .= "<td>".$tabGite['tarifHS']." €</td>";
							echo "<tr>".$ligne."</tr>";
						}
					?>
				</table>
			</div>
			<div id="colonnedroite">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto4'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto5'); ?>">
				<img class="thumbnail imageColonne" src="<?php echo $page->get('urlPhoto6'); ?>">
			</div>
		</div>
	</div>
<br><br>
</main>

