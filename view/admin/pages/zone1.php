<fieldset style="width:80%;margin-left:10%;margin-top:20px;">
    <legend><?php echo $texte3; ?></legend>
    <textarea id="titre1" name="titre1"><?php echo htmlspecialchars_decode($page->get('titre1')); ?></textarea>
</fieldset>
<fieldset style="width:80%;margin-left:10%;margin-top:20px;">
	<legend><?php echo $texte4; ?></legend>
	<textarea id="contenu1" name="contenu1"><?php echo htmlspecialchars_decode($page->get('contenu1')); ?></textarea>
</fieldset>