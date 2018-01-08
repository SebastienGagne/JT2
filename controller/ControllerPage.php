<?php

require_once(File::build_path(array('model','Model.php')));
require_once(File::build_path(array('model','ModelPage.php')));
require_once(File::build_path(array('model','ModelGites.php')));
require_once(File::build_path(array('model','ModelReservation.php')));
require_once(File::build_path(array('model','ModelSupplements.php')));
require_once(File::build_path(array('model','ModelBaniere.php')));

class ControllerPage {

	protected static $object = 'page';

	// pages "classiques"
	public static function loadDefault() {
		$nomPage = Util::myGet('nomPage');
		if (is_null($nomPage)) $nomPage = "accueil";
    	$page = ModelPage::select($nomPage);
    	//Util::disp("page=",$page);
    	$type = $page->get('typePage');
		//Util::disp($nomPage.", type $type",$page);
		$pagetitle = $page->get('title');
		$nomBaniere = "Baniere";
		if ($page->get('nomBaniere') != "") $nomBaniere = $page->get('nomBaniere');
		$baniere = ModelBaniere::select($nomBaniere);
		if ($nomPage == 'TarifsSupplements') {
			
		}
    	require_once(File::build_path(array('view','nonAdmin','view.php')));
	}

	// page d'accueil
	public static function loadAccueil() {
		//Util::disp("post=",$_POST);
		$nomPage = "accueil";
    	$page = ModelPage::select($nomPage);
    	$type = $page->get('typePage');
		//Util::disp($nomPage.", type $type",$page);
		$pagetitle = $page->get('title');
		$nomBaniere = "Baniere";
		if ($page->get('nomBaniere') != "") $nomBaniere = $page->get('nomBaniere');
		$baniere = ModelBaniere::select($nomBaniere);
		if (isset($_POST['message'])) {
			// envoi du mail correspondant à la demande au propriétaire
			$p = utf8_decode($_POST['prenom']);
			$n = utf8_decode($_POST['nom']);
			//$to       = 'contact@aubelvederedechoriol.fr';
			$to = "sebastien.gagne41@orange.fr";
			$subject = utf8_decode("message de $p $n");
			$msg  = "de $p $n :\r\n";
			$msg .= utf8_decode($_POST['message']);
		    $headers  = 'From: '.$_POST['email'];
			mail($to, $subject, $msg, $headers);
			// envoi du mail correspondant au demandeur
			/*Util::disp("POST = ",$_POST);
			Util::disp("p = ",$p);
			Util::disp("n = ",$n);
			Util::disp("to = ",$to);
			Util::disp("subject = ",$subject);
			Util::disp("msg = ",$msg);
			Util::disp("headers = ",$headers);*/
		}
		if (isset($_POST['demande'])) {
			// envoi du mail correspondant à la demande au propriétaire
			//$to       = 'contact@aubelvederedechoriol.fr';
			$to       = 'sebastien.gagne41@orange.fr';
			$subject  = utf8_decode('demande de réservation - ').$_POST['gite'];
			$msg    = 'de '.utf8_decode($_POST['prenom'])." ".utf8_decode($_POST['nom'])." :\r\n";
			$msg   .= utf8_decode('demande de réservation du gîte ').$_POST['gite']."\r\n";
			$msg   .= utf8_decode(' - date d\'arrivée souhaitée : ').$_POST['jourArrivee']."\r\n";
			$msg   .= utf8_decode(' - date de départ souhaitée : ').$_POST['jourDepart']."\r\n";
			$msg   .= utf8_decode(' - contact tel : ').$_POST['telephone']."\r\n";
			$msg   .= utf8_decode(' - message : ')."\r\n".utf8_decode($_POST['message']);
			$headers  =   'From: '.$_POST['mail'];
			mail($to, $subject, $msg, $headers);
			// envoi du mail correspondant au demandeur
			$to       = $_POST['mail'];
			$subject  = utf8_decode('votre demande de réservation - ').$_POST['gite'];
			$msg    = utf8_decode('Bonjour '.$_POST['prenom'])." ".utf8_decode($_POST['nom'])." :\r\n";
			$msg   .= utf8_decode('Nous avons bien reçu votre demande de réservation du gîte ').$_POST['gite']."\r\n";
			$msg   .= utf8_decode(' - date d\'arrivée souhaitée : ').$_POST['jourArrivee']."\r\n";
			$msg   .= utf8_decode(' - date de départ souhaitée : ').$_POST['jourDepart']."\r\n";
			$msg   .= utf8_decode('Nous traitons votre demande dès que possible et nous vous recontactons rapidement.'."\r\n");
			$msg   .= utf8_decode('Cordialement, JT'."\r\n");
			$headers  =   'From: contact@aubelvederedechoriol.fr';
			mail($to, $subject, $msg, $headers);
			// insertion dans la base de données
			ModelReservation::insertionDemande($_POST['gite'],0,$_POST['jourArrivee'],$_POST['jourDepart'],$_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['telephone'],$_POST['adresse'],$_POST['cp'],$_POST['ville'],$_POST['pays'],$_POST['message']);
			$gite = $_POST['gite'];
			$tabNomsGites = array();
			$tabNomsGites['Banne'] = 'La Banne';
			$tabNomsGites['Sancy'] = 'Le Sancy';
			$tabNomsGites['GrandGite'] = 'Banne-Sancy';
			$baniere = ModelBaniere::select("Baniere");
			$type = "Planning";
			// calcul du calendrier
			$jour_actuel = date("j", time());
			$mois_actuel = date("m", time());
			$an_actuel = date("Y", time());
			$jour = $jour_actuel;
			$an = "";
			$mois = "";
			// récupération du mois et de l'année éventuellement passés en GET via les boutons du calendrier
			extract($_GET);
			// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
			if (!isset($_GET["mois"])) {
				$mois = $mois_actuel;
				$an = $an_actuel;
			}
			$cal = ModelGites::buildCalendar($gite,$mois,$an,"");
			$form = ModelReservation::formulaireResa();
			//Util::disp("cal",$cal);
		}
    	require_once(File::build_path(array('view','nonAdmin','view.php')));
	}

	// page tarifs gîtes
	public static function loadTarifsGites() {
		$nomPage = 'tarifsGites';
    	$page = ModelPage::select($nomPage);
    	$type = $page->get('typePage');
    	//Util::disp($nomPage.", type $type",$page);
		$pagetitle = $page->get('title');
		$nomBaniere = "Baniere";
		if ($page->get('nomBaniere') != "") $nomBaniere = $page->get('nomBaniere');
		$baniere = ModelBaniere::select($nomBaniere);
		$tarifGites = ModelGites::getTarifGites();
		//Util::disp("tarifs gîtes = ",$tarifGites);
    	require_once(File::build_path(array('view','nonAdmin','view.php')));
	}

	// pages plannings

	public static function loadPlanning() {
		$gite = $_GET['gite'];
		$nomPage = $gite;
    	$page = ModelPage::select($nomPage);
		$tabNomsGites = array();
		$tabNomsGites['Banne'] = 'La Banne';
		$tabNomsGites['Sancy'] = 'Le Sancy';
		$tabNomsGites['GrandGite'] = 'Banne-Sancy';
		$nomBaniere = "Baniere";
		if ($page->get('nomBaniere') != "") $nomBaniere = $page->get('nomBaniere');
		$baniere = ModelBaniere::select($nomBaniere);
		$type = "Planning";
		// calcul du calendrier
		$jour_actuel = date("j", time());
		$mois_actuel = date("m", time());
		$an_actuel = date("Y", time());
		$jour = $jour_actuel;
		// récupération du mois et de l'année éventuellement passés en GET via les boutons du calendrier
		extract($_GET);
		// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
		if (!isset($_GET["mois"])) {
			$mois = $mois_actuel;
			$an = $an_actuel;
		}
		$cal = ModelGites::buildCalendar($gite,$mois,$an,"");
		$form = ModelReservation::formulaireResa();
    	require_once(File::build_path(array('view','nonAdmin','view.php')));
	}

	// page suppléments
	public static function loadSupplements() {
		$nomBaniere = "Baniere";
		$page = ModelPage::select('tarifsSupplements');
		if ($page->get('nomBaniere') != "") $nomBaniere = $page->get('nomBaniere');
		$baniere = ModelBaniere::select($nomBaniere);
		$type = "supplements";
		$tarifsSupplements = ModelSupplements::getTarifsSupplements();
		$supplementsOfferts = ModelSupplements::getSupplementsOfferts();
		$supplementsTarifUnique = ModelSupplements::getSupplementsTarifUnique();
		$liste1 = "";
		foreach ($tarifsSupplements as $i => $supplement) {
			if (($i == 13) || ($i == 11) || ($i == 10) || ($i == 12) || ($i == 7)) {
				$liste1 .= "<img src='img/boutons/plus2.png' style='cursor:pointer;margin:5px 10px;' id='image".$i."' onclick='montrerCacher(".$i.");'><span style='cursor:pointer;' onclick='montrerCacher(".$i.");'>".$supplement['libelle']."</span><div id='desc".$i."' style='display:none;'><p style='padding:10px;font-style:italic;'>".$supplement['descriptif']."</p></div>"."<br>";
				//$liste1 .= "<img src='http://www.toutdeaaz.fr/JT2/img/boutons/plus2.png' style='cursor:pointer;margin:5px 10px;' id='image".$i."' onclick='montrerCacher(".$i.");'><span style='cursor:pointer;' onclick='montrerCacher(".$i.");'>".$supplement['libelle']."</span><div id='desc".$i."' style='display:none;'><p style='padding:10px;font-style:italic;'>".$supplement['descriptif']."</p></div>"."<br>";
			}
		}
		$liste2 = "";
		foreach ($tarifsSupplements as $i => $supplement) {
			if (($i == 0) || ($i == 1) || ($i == 2) || ($i == 4) || ($i == 5) || ($i == 8)) {
				//$liste2 .= "<img src='../choriol/img/boutons/plus2.png' style='cursor:pointer;margin:5px 10px;' id='image".$i."' onclick='montrerCacher(".$i.");'><span style='cursor:pointer;' onclick='montrerCacher(".$i.");'>".$supplement['libelle']."</span><div id='desc".$i."' style='display:none;'><p style='padding:10px;font-style:italic;'>".$supplement['descriptif']."</p></div>"."<br>";
				$liste2 .= "<img src='img/boutons/plus2.png' style='cursor:pointer;margin:5px 10px;' id='image".$i."' onclick='montrerCacher(".$i.");'><span style='cursor:pointer;' onclick='montrerCacher(".$i.");'>".$supplement['libelle']."</span><div id='desc".$i."' style='display:none;'><p style='padding:10px;font-style:italic;'>".$supplement['descriptif']."</p></div>"."<br>";
			}
		}
    	require_once(File::build_path(array('view','nonAdmin','view.php')));
	}

}