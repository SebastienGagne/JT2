<?php

require_once(File::build_path(array('model','Model.php')));
require_once(File::build_path(array('model','ModelUser.php')));

class ControllerUser {

	protected static $object = 'utilisateur';

	public static function connect() {
		$tab_v = ModelUser::selectAll();
		$tabLoginMdp = array();
		//Util::disp("utilisateur",$tab_v);
	}

	public static function connected() {
		$login = Util::myGet('login');
		$v = ModelUser::select($login);
		$mdp = Util::myGet('mdp');
		$nonce = $v->get('nonce');
		if (is_null($nonce)) {
			if (ModelUser::checkPassword($login,Security::chiffrer($mdp))) {
				$_SESSION['login'] = $login;
				$_SESSION['admin'] = $v->get('admin');
				ControllerUser::read();
			} else {
				ControllerUser::readAll();
			}
		} else {
			ControllerUser::connect();
		}
	}

	public static function deconnect() {
		session_unset();
		session_destroy();
		setcookie(session_name(),'',time()-1);
		ControllerUser::readAll();
	}

	public static function validate() {
		$login = Util::myGet('login');
		$nonce = Util::myGet('nonce');
		$v = ModelUser::select($login);
		if (($v) && ($v->get('nonce') == $nonce)) {
			ModelUser::setNonceNULL($login);
		}
	}

	public static function readAll() {
		$tab_v = ModelUser::selectAll();
		$tabLoginMdp = array();
		Util::disp("utilisateur",$tab_v);
  	}

  	public static function read() {
    	$login = Util::myGet('login');
    	$v = ModelUser::select($login);
    	$l_esc = htmlspecialchars($v->get('login'));
		$n_esc = htmlspecialchars($v->get('nom'));
		$p_esc = htmlspecialchars($v->get('prenom'));
		$fonction = "";
		$fonction = Session::is_admin() ? "Administrateur" : "Utilisateur";
		if (Session::is_admin() || Session::is_user($login)) {
			$aff_detail = "<p>$fonction $l_esc ($p_esc $n_esc)|| <a href='index.php?action=delete&controller=utilisateur&login=".$l_esc."'>supprimer cet utilisateur</a>|| <a href='index.php?action=update&controller=utilisateur&login=".$l_esc."'>modifier cet utilisateur</a></p>";
		} else {
			$aff_detail = "<p>$fonction $l_esc ($p_esc $n_esc)</p>";
		}
    	$pagetitle = "Détails $fonction ".$login;
    	if (!$v) {
      		$view = 'error1';
		} else {
			$view = 'detail';
		}
    	require_once(File::build_path(array('view','view.php')));
  	}

  	public static function create() {
		//"redirige" vers la vue
		$l = '';
    	$p = '';
    	$n = '';
		$em = '';
    	$aff_isadmin = "";
    	$autorisation = 'required';
    	$action_value = 'created';
    	$view = 'update';
    	$pagetitle = 'Liste des utilisateurs';
    	require_once(File::build_path(array('view','view.php')));
  	}

	public static function created() {
		// récupération des éléments dans l'URL
		$l = Util::myGet('login');
		$p = Util::myGet('prenom');
		$n = Util::myGet('nom');
		$em = filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL);
		$mdp1 = Util::myGet('mdp1');
		$mdp2 = Util::myGet('mdp2');
		$grh = Security::generateRandomHex();
		$data = array(
			'login' => $l,
			'prenom' => $p,
			'nom' => $n,
			'email' => $em,
			'mdp_clair' => $mdp1,
			'mdp' => Security::chiffrer($mdp1),
			'nonce' => $grh
		);
		$controller = 'utilisateur';
		$pagetitle = 'Liste des utilisateurs';
		if ($mdp1 == $mdp2) {
			if (ModelUser::save($data)) {
				$view = 'created';
			} else {
				$view = 'errorUser';
			}
		} else {
			$view = 'errorUser';
		}
		$url = "http://webinfo.iutmontp.univ-montp2.fr/~etugagne/PHP/TD8/index.php?action=validate&controller=utilisateur&login=".$l."&nonce=".$grh;
		$subject = 'confirmation de votre inscription';
		$mail = "
			<html>
			  <head>
			    <title>mail</title>
			  </head>
			  <body>
					<div style='margin:20px;'>
			    	cliquez<a href='".$url."'> ici </a> pour valider votre inscription
					</div>
			  </body>
			</html>
		";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		// Envoi
    	mail($em, $subject, $mail, $headers);
		ControllerUser::readAll();
	}

  	public static function delete() {
	    // récupération des éléments dans l'URL
	    $pagetitle = 'Suppression d\'un utilisateur';
	    $login = Util::myGet('login');
	    if (Session::is_user($login) || Session::is_admin()) {
	      	if (ModelUser::delete($login)) {
	        	ControllerUser::readAll();
	      	} else {
	        	$view = 'error1062';
	        	require_once(File::build_path(array('view','view.php')));
	      	}
	    } else {
	    	ControllerUser::connect();
	    }
  	}

  	public static function update() {
	    //"redirige" vers la vue
	    $login = Util::myGet('login');
	    if (Session::is_user($login) || Session::is_admin()) {
	    	$u = ModelUser::select($login);
	    	$l = $u->get('login');
	    	$p = $u->get('prenom');
	    	$n = $u->get('nom');
				$em = $u->get('email');
	    	$a = $u->get('admin');
	    	//echo "<pre>isadmin";print_r($a);echo "</pre>";
	    	$aff_isadmin = "";
	    	if (Session::is_admin()) {
	        $ligne_input = $a ? "<input type='checkbox' name='isadmin' id='isadmin' checked value='on'>" : "<input type='checkbox' name='isadmin' id='isadmin' value=''>";
	        $aff_isadmin = "
	        	<p>
	      				<label for='isadmin_id'>administrateur ?</label>".$ligne_input."
	    			</p>";
	    	}
	    	$autorisation = 'readonly';
	    	$action_value = 'updated';
	    	$view = 'update';
	    	$pagetitle = 'Liste des utilisateurs';
	    	ControllerUser::menu();
	    	require_once(File::build_path(array('view','view.php')));
	    } else {
	    	ControllerUser::connect();
	    }
  	}

	public static function updated() {
		// récupération des éléments dans l'URL
		$login = Util::myGet('login');
		if (Session::is_user($login) || Session::is_admin()) {
			$p = Util::myGet('prenom');
			$n = Util::myGet('nom');
			$em = Util::myGet('email');
			$mdp1 = Util::myGet('mdp1');
			$mdp2 = Util::myGet('mdp2');
			//$a = isset($_GET['isadmin']) ? $_GET['isadmin'] : 'off';
			$a = !is_null(Util::myGet('isadmin'));
			$data = array(
				'login' => $login,
				'prenom' => $p,
				'nom' => $n,
				'email' => $em,
				'mdp_clair' => $mdp1,
				'mdp' => Security::chiffrer($mdp1),
				'admin' => $a
			);
			$controller = 'utilisateur';
			$pagetitle = 'Liste des utilisateurs';
			if ($mdp1 == $mdp2) {
				if (ModelUser::update($data)) {
					$view = 'updated';
				} else {
					$view = 'errorUser';
				}
			} else {
				$view = 'errorUser';
			}
			ControllerUser::readAll();
    	} else {
    		ControllerUser::connect();
    	}
  	}

  	public static function preferences() {
    	$controller = 'utilisateur';
		$pagetitle = 'vos préférences';
		$view = 'preferences';
		require_once(File::build_path(array('view','view.php')));
  	}

  	public static function personnalisation() {
    	$preference = Util::myGet('preference');
		setcookie("preference",$preference,time()+3600);
		$controller = 'utilisateur';
		$pagetitle = 'merci';
		$view = 'thanks';
		require_once(File::build_path(array('view','view.php')));
  	}

  	public static function error() {
    	$controller = 'utilisateur';
    	$view = 'errorUser';
    	$pagetitle = 'Erreur';
    	$erroraction = Util::myGet('action');
    	require_once(File::build_path(array('view','view.php')));
	}

	public static function menu() {
		$menu = "
			<nav>
   				<div><a href='index.php?action=readAll&controller=voiture'>voitures</a></div>
   				<div><a href='index.php?action=readAll&controller=utilisateur'>utilisateurs</a></div>
   				<div><a href='index.php?action=readAll&controller=trajet'>trajets</a></div>
   				<div><a href='index.php?action=preferences&controller=utilisateur'>préférences</a></div>";
		if (isset($_SESSION['login'])) {
			$menu .= "
				<div><a href='index.php?action=deconnect&controller=utilisateur'>déconnexion</a></div>";
		} else {
			$menu .= "<div><a href='index.php?action=connect&controller=utilisateur'>connexion</a></div>";
		}
		$menu .= "
			</nav>";
		return $menu;
	}

	public static function bienvenue() {
		$bienvenue = "<p style='border: 1px solid black;text-align:left;padding:5px;background-color:lightgrey;'> bonjour";
		if (isset($_SESSION['login'])) {
			$bienvenue .= ", ".$_SESSION['login'];
		}
		$bienvenue .= " !</p>";
		return $bienvenue;
	}

	public static function footer() {
		$footer = "<footer><p id='pfooter'>Site de covoiturage de moi-même</p></footer>";
		return $footer;
	}

}
