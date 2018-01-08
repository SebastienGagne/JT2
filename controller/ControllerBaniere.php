<?php

require_once(File::build_path(array('model','Model.php')));
require_once(File::build_path(array('model','ModelBaniere.php')));

class ControllerBaniere {

	protected static $object = 'baniere';

	public static function readAll() {
		$tab_b = ModelBaniere::selectAll();
		//Util::disp("toutes les banières = ",$tab_b);
		$type = 'listeBanieres';
		$affichage = array();
		foreach ($tab_b as $b) {
			$affichage_b = array();
			$pres = $b->get('nomBaniere')."<br>";
			$im1 = "<img class='imgBan' src='".$b->get('urlBaniere1')."' alt='image1'>";
			$im2 = "<img class='imgBan' src='".$b->get('urlBaniere2')."' alt='image2'>";
			$im3 = "<img class='imgBan'' src='".$b->get('urlBaniere3')."' alt='image3'>";
			$im4 = "<img class='imgBan' src='".$b->get('urlBaniere4')."' alt='image4'>";

			$ligne = $im1.$im2.$im3.$im4;
			$lien = "<div class='boutonSG'><a href='index.php?controller=baniere&action=modify&nomBaniere=".$b->get('nomBaniere')."'> modifier la banière </a></div><hr>";
			$affichage_b['ligne'] = $ligne;
			$affichage_b['pres'] = $pres;
			$affichage_b['lien'] = $lien;
			$affichage[] = $affichage_b;
		}
		require_once(File::build_path(array('view','admin','view.php')));
	}

	public static function lien_baniere_page() {
		$tab_b = ModelBaniere::selectAll();
		$tab_p = ModelPage::selectAll();
		$type = 'lienBanierePage';
		$tab_lien = array();
		$table = "<table class='admtab'><thead><tr class='admtr'><th class='admth'>page</th>";
		foreach ($tab_b as $baniere) {
			$table .= "<th class='admth'>".$baniere->get('nomBaniere')."</th>";
		}
		$table .= "</tr></thead>";
		$table .= "<tbody>";
		foreach ($tab_p as $i => $page) {
			$ligne = "<tr class='admtr'><td class='celluletitre'>".$page->get('nomPage')."</td>";
			foreach ($tab_b as $j => $baniere) {
				if ($page->get('nomBaniere') == $baniere->get('nomBaniere')) {
					$ligne .= "<td class='admtd'><input type='radio' checked name='".$page->get('nomPage')."' value='".$baniere->get('nomBaniere')."'></td>";
				} else {
					$ligne .= "<td class='admtd'><input type='radio' name='".$page->get('nomPage')."' value='".$baniere->get('nomBaniere')."'></td>";
				}
				
			}
			$ligne .= "</tr>";
			$table .= $ligne;
		}
		$table .= "</tbody></table>";
		require_once(File::build_path(array('view','admin','view.php')));
	}

	public static function affectation_banieres() {
		//Util::disp("post",$_POST);
		$table_name = "page";
		$primary_key = "nomPage";
		$data = array();
		foreach ($_POST as $nomPage => $nomBaniere) {
			Model::update(array('nomBaniere' => $nomBaniere,'nomPage' => $nomPage),'page','nomPage');
		}
		ControllerBaniere::lien_baniere_page();

	}

	// modification de baniere
	public static function modify() {
		$nb = Util::myGet('nomBaniere');
		$baniere = ModelBaniere::select($nb);
		//Util::disp("baniere = ",$baniere);
		$type = 'baniere';
		require_once(File::build_path(array('view','admin','view.php')));
	}

	public static function modified() {
		//Util::disp("GET : ",$_GET);
		//Util::disp("POST : ",$_POST);
		//Util::disp("FILES : ",$_FILES);
		extract($_GET);
		extract($_POST);
		$table_name = "baniere";
		$primary_key = "nomBaniere";
		$data = array();
		$data['nomBaniere'] = ucfirst($nomBaniere);
		$url = array('urlBaniere1','urlBaniere2','urlBaniere3','urlBaniere4');
		for ($i = 0; $i < 4 ; $i++) { 
			if (!empty($_FILES[$url[$i]]) && is_uploaded_file($_FILES[$url[$i]]['tmp_name'])) {
   				$name = $_FILES[$url[$i]]['name'];
				$pic_path = "img/photosJT/$name";
				if (!move_uploaded_file($_FILES[$url[$i]]['tmp_name'], $pic_path)) {
  					echo "La copie a échoué";
				}
				$url[$i] = $pic_path;
				$j = $i + 1;
				$data["urlBaniere$j"] = $url[$i];
			}
			
		}
		//Util::disp("data : ",$data);
		Model::update($data, $table_name, $primary_key);
		ControllerBaniere::readAll();
	}

}