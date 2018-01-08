<?php

require_once(File::build_path(array('model','Model.php')));
require_once(File::build_path(array('model','ModelReservation.php')));

class ControllerReservation {

	public static function rejeterDemande() {
		extract($_GET);
		extract($_POST);
		foreach ($_POST as $key => $value) {
			if ($value == 'rejeter') {
				//ModelReservation::classerDemande($gite,$key,2);
				ModelReservation::deleteAllResaByJour($gite,$id);
			}
		}
		ControllerReservation::gererDemandes();
	}

	public static function validerDemande() {
		extract($_GET);
		extract($_POST);
		foreach ($_POST as $key => $value) {
			if ($value == 'valider') {
				//ModelReservation::classerDemande($gite,$key,2);
				ModelReservation::classerDemande($gite,$key,1);
			}
		}
		ControllerReservation::gererDemandes();
	}

	public static function effacerJour() {
		extract($_GET);
		extract($_POST);
		if (isset($_POST['deleteDay'])) {
			ModelReservation::deleteResaByJour($gite,$jour);
		}
		ControllerReservation::gererDemandes();
	}

	public static function effacerResa() {
		extract($_GET);
		extract($_POST);
		if (isset($_POST['deleteResa'])) {
			ModelReservation::deleteAllResaByJour($gite,$id);
		}
		ControllerReservation::gererDemandes();
	}

	public static function gererDemandes() {
		extract($_GET);
		extract($_POST);
		//util::disp("post",$_POST);
		
		// traitement d'une éventuelle action valider/rejeter en provenance de la page gererDemandes
		if (sizeof($_POST) > 0) {
			foreach ($_POST as $key => $value) {
				if ($value == 'rejeter') {
					//ModelReservation::classerDemande($gite,$key,2);
					ModelReservation::deleteAllResaByJour($gite,$key);
				} else {
					ModelReservation::classerDemande($gite,$key,1);
				}
			}
		}
		if (isset($_POST['deleteDay'])) {
			ModelReservation::deleteResaByJour($gite,$jour);
		}
		if (isset($_POST['deleteResa'])) {
			ModelReservation::deleteAllResaByJour($gite,$id);
		}

		// récupération des demandes état 0 ou état 1
		$tabDemandes0 = ModelReservation::recupererDemandes($gite,0);
		//Util::disp("demande état 0 pour $gite = ",$tabDemandes0);
		$idDemandesEtat0 = ModelReservation::idDemandes($gite,0);
		//Util::disp("identifiants état 0 pour $gite = ",$idDemandesEtat0);
		
		
		$tab0 = Array();
		foreach ($idDemandesEtat0 as $key => $value) {
			$idDem = $value['id'];
			$tab0[] = ModelReservation::demande($gite,0,$idDem);
		}
		$tabDemandes1 = ModelReservation::recupererDemandes($_GET['gite'],1);
		//Util::disp("demande état 1 pour $gite = ",$tabDemandes1);

		// calcul du message global à afficher
		$size = sizeof($idDemandesEtat0);
		$message_global = "";
		switch($size) {
			case 0: 
				$message_global = "<h3> Gîte $gite - il y n'a pas de nouvelle demande.</h3>";
				break;
			case 1:
				$message_global = "<h3> Gîte $gite - il y a 1 demande non traitée.</h3>";
				break;
			default:
				$message_global = "<h3> Gîte $gite - il y a $size demandes non traitées.</h3>";
		}
		$tableau_messages_demandes = array();
		$mess = "";
		foreach ($tab0 as $key => $value) {
			$mess  = "<h3>demande ".($key + 1)."</h3><br>";
			$mess .= "- nom, prénom : ".$value['nom']." ".$value['prenom']."<br>";
			$mess .= "- adresse     : ".$value['adresse']." ".$value['codepostal']." ".$value['ville']."<br>";
			$mess .= "- arrivée     : ".$value['jour']."<br>";
			$mess .= "- durée       : ".$value['nbjours']." nuitées.<br>";
			$mess .= "- téléphone   : ".$value['telephone']."<br>";
			$mess .= "- email       : <a href='mailto:".$value['email']."'>".$value['email']."</a><br>";
			$mess .= "- message     : ".$value['message']."<br>";
			$mess .= "<input type='submit' name='".$value['id']."' value='valider'> "." <input type='submit' name='".$value['id']."' value='rejeter'><hr>";
			$tableau_messages_demandes[] = $mess;
		}

		// le planning
		$jour_actuel = date("j", time());
		$mois_actuel = date("m", time());
		$an_actuel = date("Y", time());
		$jour = $jour_actuel;
		// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
		if (!isset($_GET["mois"])) {
			$mois = $mois_actuel;
			$an = $an_actuel;
		}
		$cal = ModelGites::buildCalendar($gite,$mois,$an,"");

		$type = 'demandes';
		require_once(File::build_path(array('view','admin','view.php')));
	}
	
	public static function creerResa() {
		if (isset($_POST['demande'])) {
			// insertion dans la base de données
			ModelReservation::insertionResaManuelle($_POST['gite'],$_POST['jourArrivee'],$_POST['jourDepart'],$_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['telephone'],$_POST['adresse'],$_POST['cp'],$_POST['ville'],$_POST['pays'],$_POST['message']);
		}
		// calcul du calendrier
		$mois_actuel = date("m", time());
		$an_actuel = date("Y", time());
		// récupération du mois et de l'année éventuellement passés en GET via les boutons du calendrier
		extract($_GET);
		// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
		if (!isset($_GET["mois"])) {
			$mois = $mois_actuel;
			$an = $an_actuel;
		}
		$cal = ModelGites::buildCalendar($gite,$mois,$an);
		$form = ModelReservation::formulaireResa();
		$type = "creerResa";
    	require_once(File::build_path(array('view','admin','view.php')));
	}

	public static function editerResa() {
		extract($_GET);
		extract($_POST);
		//Util::disp("post = ",$_POST);
		// calcul du calendrier
		$mois_actuel = date("m", time());
		$an_actuel = date("Y", time());
		// récupération du mois et de l'année éventuellement passés en GET via les boutons du calendrier
		// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
		if (!isset($_GET["mois"])) {
			$mois = $mois_actuel;
			$an = $an_actuel;
		}
		$cal = ModelGites::buildCalendar($gite,$mois,$an,$jour);
		$resa = ModelReservation::getResaByJour($gite,$jour);
		$affichage_resa = ModelReservation::afficherResa($resa);//Util::disp("resa=",$resa);
		$type = "editerResa";
    	require_once(File::build_path(array('view','admin','view.php')));
	}

}