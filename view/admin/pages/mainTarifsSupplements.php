<main style="margin:0px 20px 0px 20px;">
	<form action="index.php?controller=pageAdmin&action=modified&nomPage=<?php echo $page->get('nomPage'); ?>" method="post" enctype='multipart/form-data'>
	    <?php include_once("zone1.php"); ?>
	    <?php include_once("zone2.php"); ?>
	    <?php 
	        Util::disp('tarifs Supplements',$tarifsSupplements);
	        
	    ?>
	    <?php include_once("boutonvalider.php"); ?>
	</form>
</main>
