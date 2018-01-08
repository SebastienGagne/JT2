<script type="text/javascript">
	function montrerCacher(i) {
		//alert(i);
		var image_i = document.getElementById("image"+i);
		var j;
		for (j = 0; j < 14; j++) {
			if ((j != 3) && (j != 6) && (j != 9)) {
				document.getElementById("desc"+j).style.display = "none";
				//document.getElementById("image"+j).src = "../choriol/img/boutons/plus2.png";
				document.getElementById("image"+j).src = "http://www.toutdeaaz.fr/JT2/img/boutons/plus2.png";
			}
		}
		if (image_i.src == "http://www.toutdeaaz.fr/JT2/img/boutons/plus2.png") {
			document.getElementById('desc' + i).style.display = "block";
			//image_i.src = "http://localhost/~gagne/choriol/img/boutons/moins2.png";
			image_i.src = "http://www.toutdeaaz.fr/JT2/img/boutons/moins2.png";
		} else {
			document.getElementById('desc' + i).style.display = "none";
			//image_i.src = "http://localhost/~gagne/choriol/img/boutons/plus2.png";
			image_i.src = "http://www.toutdeaaz.fr/JT2/img/boutons/plus2.png";
		}		
	}
</script>

<main class="mainAccueil">
	<div id="presentation">
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></h2>
		<div id="tableaupresentation">
			<div id="colonnecentrale" style="width:100%;">
				<p><?php echo htmlspecialchars_decode($page->get('contenu1')); ?></p>
				<?php echo $liste1; ?>
				<br><br>
				<p><?php echo htmlspecialchars_decode($page->get('contenu2')); ?></p>	
				<?php echo $liste2; ?>
				<br><br>
			</div>
		</div>
	</div>
</main>

