<?php
// inclusion du head
require_once(File::build_path(array('view','nonAdmin','head.html')));
// inclusion du header (menu et banière)
require_once(File::build_path(array('view','nonAdmin','header.php')));
// inclusion du main
require_once(File::build_path(array('view','nonAdmin','pages','main'.ucfirst($type).'.php')));
// inclusion du footer
require_once(File::build_path(array('view','nonAdmin','footer.html')));
