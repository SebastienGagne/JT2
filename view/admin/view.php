<?php
// inclusion du head
require_once(File::build_path(array('view','admin','head.html')));
// inclusion du header (menu et banière)
require_once(File::build_path(array('view','admin','header.php')));
// inclusion du main
require_once(File::build_path(array('view','admin','pages','main'.ucfirst($type).'.php')));
// inclusion du footer
require_once(File::build_path(array('view','admin','footer.html')));
?>