<?php

class File {

	public static function build_path($path_array) {
	  // version non portable
	  // $ROOT_FOLDER = "/home/ann1/etugagne/public_html/PHP/TD5";
		// version portable
	  // DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur
	  // Linux et '\' sur Windows
		$DS = DIRECTORY_SEPARATOR;
	  // __DIR__ est une constante "magique" de PHP qui contient
	  // le chemin du dossier courant
	  $ROOT_FOLDER = __DIR__."/..";
	  return $ROOT_FOLDER. $DS . join($DS, $path_array);
	}
	
}

?>
