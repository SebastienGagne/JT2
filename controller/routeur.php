<?php
require_once(File::build_path(array('controller','ControllerPage.php')));
require_once(File::build_path(array('controller','ControllerPageAdmin.php')));
require_once(File::build_path(array('controller','ControllerReservation.php')));
require_once(File::build_path(array('controller','ControllerBaniere.php')));
require_once(File::build_path(array('controller','ControllerPageConnexion.php')));
require_once(File::build_path(array('controller','ControllerUser.php')));

////////////////////////////////////
//   cas d'un utilisateur admin   //
////////////////////////////////////

if (Session::is_admin()) {
	$action = "loadDefault";
	$controller = 'pageAdmin';
	if (!is_null(Util::myGet('action'))) {
		$action = Util::myGet('action');
	}
	if (($action == 'deconnect') || ($action == 'connect') || ($action == 'connected')) {
		$controller = 'pageConnexion';
	}
	if (!is_null(Util::myGet('controller'))) {
		$controller = Util::myGet('controller');
	}
	$controller_class = "Controller".ucfirst($controller);
	// Appel de la méthode statique $action de ControllerVoiture
	$controller_class::$action();
}
////////////////////////////////////
// cas d'un utilisateur non-admin //
////////////////////////////////////

else {
	$controller = 'page';
	$action = 'loadDefault';
	if (!is_null(Util::myGet('controller'))) {
		$controller = Util::myGet('controller');
		if ($controller == 'pageAdmin') $controller = 'page';
	}

	if (!is_null(Util::myGet('action'))) {
		$action = Util::myGet('action');
	}

	if (($action == 'connect') || ($action == 'connected')) {
		$controller = 'pageConnexion';
	}

	$controller_class = "Controller".ucfirst($controller);
	$controller_class::$action();
}

?>
