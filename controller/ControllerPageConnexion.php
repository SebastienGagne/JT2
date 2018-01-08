<?php

require_once(File::build_path(array('model','Model.php')));
require_once(File::build_path(array('model','ModelUser.php')));

class ControllerPageConnexion {

	protected static $object = 'pageConnexion';

	public static function connect() {
		require_once(File::build_path(array('view','connexion','viewConnect.php')));
	}

	public static function connected() {
		//Util::disp("GET = ",$_GET);
		$login = Util::myGet('login');
		$mdp = Util::myGet('mdp');
		if (ModelUser::checkPassword($login,Security::chiffrer($mdp))) {
			$v = ModelUser::select($login);
			//Util::disp("v = ",$v);
			$nonce = $v->get('nonce');
			if (is_null($nonce)) {
				$_SESSION['login'] = $login;
				$_SESSION['admin'] = $v->get('isAdmin');

				ControllerPageAdmin::loadDefault();
			} else {
				ControllerPage::loadDefault();
			}
		} else {
			ControllerPageConnexion::connect();
		}
	}

	public static function deconnect() {
		session_unset();
		session_destroy();
		setcookie(session_name(),'',time()-1);
		ControllerPageConnexion::connect();
	}

}