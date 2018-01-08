<?php

class Util {

	public static function disp($string,$array) {
	  echo "<pre><div class='affichage'>";
    echo "<b>contenu de $string</b><br>";
    print_r($array);
    echo "</div></pre>";
	}

	public static function keys($string,$array) {
    echo "<pre><div class='affichage'>";
    echo "<b>keys de $string</b><br>";
    print_r(array_keys($array));
    echo "</div></pre>";
	}

	public static function myGet($nomvar) {
		if (isset($_GET[$nomvar])) {
			return $_GET[$nomvar];
		} else if (isset($_POST[$nomvar])) {
			return $_POST[$nomvar];
		} else {
			return NULL;
		}
	}

}

?>
