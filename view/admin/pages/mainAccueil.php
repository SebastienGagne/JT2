<main style="margin:0px 20px 0px 20px;">
    <form action="index.php?controller=pageAdmin&action=modified&nomPage=<?php echo $page->get('nomPage'); ?>" method="post" enctype='multipart/form-data'>
        <?php include_once("zone1.php"); ?>
        <?php include_once("photos.php"); ?>
        <fieldset style="width:80%;margin-left:10%;margin-top:20px;">
            <legend>Titre de la zone "Coordonnées"</legend>
            <textarea id="titre2" name="titre2"><?php echo htmlspecialchars_decode($page->get('titre2')); ?></textarea>
        </fieldset>
        <fieldset style="width:80%;margin-left:10%;margin-top:20px;">
            <legend>Les coordonnées</legend>
            <textarea id="contenu2" name="contenu2"><?php echo htmlspecialchars_decode($page->get('contenu2')); ?></textarea>
        </fieldset>
        <fieldset style="width:80%;margin-left:10%;margin-top:20px;">
            <legend>Titre de la zone "Carte"</legend>
            <textarea id="titre3" name="titre3"><?php echo htmlspecialchars_decode($page->get('titre3')); ?></textarea>
        </fieldset>
        <fieldset style="width:80%;margin-left:10%;margin-top:20px;">
            <legend>Carte</legend>
            <textarea id="contenu3" name="contenu3"><?php echo htmlspecialchars_decode($page->get('contenu3')); ?></textarea>
        </fieldset>
        <?php include_once("boutonvalider.php"); ?>
    </form>
</main>

