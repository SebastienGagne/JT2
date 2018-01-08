<main class="mainAccueil">
	<div id="presentation">
		<h2 class="titre"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></h2>
		<div id="tableaupresentation" style="width:90%;margin-left:5%;">
			<div id="colonnecentrale" style="width:100%;">
				<?php echo htmlspecialchars_decode($page->get('contenu1')); ?>
			</div>
		</div>
	</div>
	<br>
	<div id="myCarousel2" class="carousel slide" data-ride="carousel">
      
  <!-- Indicateurs -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel2" data-slide-to="1"></li>
    <li data-target="#myCarousel2" data-slide-to="2"></li>
    <li data-target="#myCarousel2" data-slide-to="3"></li>
    <li data-target="#myCarousel2" data-slide-to="4"></li>
    <li data-target="#myCarousel2" data-slide-to="5"></li>
  </ol>
  
  <!-- photos -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="<?php echo $page->get('urlPhoto1'); ?>" alt="First slide">
    </div>
    <div class="item">
      <img class="second-slide" src="<?php echo $page->get('urlPhoto2'); ?>" alt="Second slide">
    </div>
    <div class="item">
      <img class="second-slide" src="<?php echo $page->get('urlPhoto3'); ?>" alt="Second slide">
    </div>
    <div class="item">
      <img class="second-slide" src="<?php echo $page->get('urlPhoto4'); ?>" alt="Second slide">
    </div> 
    <div class="item">
      <img class="second-slide" src="<?php echo $page->get('urlPhoto5'); ?>" alt="Second slide">
    </div> 
    <div class="item">
      <img class="second-slide" src="<?php echo $page->get('urlPhoto6'); ?>" alt="Second slide">
    </div>      
  </div>

  <!-- les boutons précédent et suivant -->
  <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>
</main>
