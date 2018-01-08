<?php

require_once(File::build_path(array('model','Model.php')));

class ControllerPageAdmin {

	protected static $object = 'pageAdmin';

	public static function simplify($content) {
		$contenu = explode("<body",$content)[1];
		$contenu = explode("</bo",$contenu)[0];
		$contenu = substr($contenu, 3);
		return $contenu;
	}

	public static function loadDefault() {
    	$type = 'Todo';
    	require_once(File::build_path(array('view','admin','view.php')));
	}

	// modification de pages
	public static function modify() {
		$nomPage = Util::myGet('nomPage');
		$page = ModelPage::select($nomPage);
		//Util::disp("page = ",$page);
		$type = $page->get('typePage');
		switch ($type) {
			case 'carousel':
				$texte1 = 'Photos 1, 2, 3 du carousel';
				$texte2 = 'Photos 4, 5, 6 du carousel';
				$texte3 = 'Titre';
				$texte4 = 'Contenu texte';
				break;
			case 'colonnes':
				$texte1 = 'Photos de la colonne de gauche';
				$texte2 = 'Photos de la colonne de droite';
				$texte3 = 'Titre de la zone à trois colonnes';
				$texte4 = 'Contenu de la colonne centrale';
				break;
			case 'accueil':
				$texte1 = 'Photos de la colonne de gauche';
				$texte2 = 'Photos de la colonne de droite';
				$texte3 = 'Titre de la zone à trois colonnes';
				$texte4 = 'Contenu de la colonne centrale';
				break;
			case 'tarifsGites':
				$tarifGites = ModelGites::getTarifGites();
				break;
			case 'tarifsSupplements':
				$tarifsSupplements = ModelSupplements::getTarifsSupplements();
				//$supplementsOfferts = ModelPage::getSupplementsOfferts();
				//$supplementsTarifUnique = ModelPage::getSupplementsTarifUnique();
				$texte5 = 'Titre zone 2';
				$texte6 = 'Contenu zone 2';
				break;
			default:
				break;
		}
		require_once(File::build_path(array('view','admin','view.php')));
	}

	public static function modified() {
		//Util::disp("GET : ",$_GET);
		//Util::disp("POST : ",$_POST);
		//Util::disp("FILES : ",$_FILES);
		extract($_GET);
		extract($_POST);
		$table_name = "page";
		$primary_key = "nomPage";
		$data = array();
		$data['nomPage'] = ucfirst($nomPage);
		$url = array('urlPhoto1','urlPhoto2','urlPhoto3','urlPhoto4','urlPhoto5','urlPhoto6');
		for ($i = 0; $i < 6 ; $i++) { 
			if (!empty($_FILES[$url[$i]]) && is_uploaded_file($_FILES[$url[$i]]['tmp_name'])) {
   				$name = $_FILES[$url[$i]]['name'];
				$pic_path = "img/photosJT/$name";
				if (!move_uploaded_file($_FILES[$url[$i]]['tmp_name'], $pic_path)) {
  					echo "La copie a échoué";
				}
				$url[$i] = $pic_path;
				$j = $i + 1;
				$data["urlPhoto$j"] = $url[$i];
			}			
		}
		$data['contenu1'] = ControllerPageAdmin::simplify($contenu1);
		$data['contenu2'] = ControllerPageAdmin::simplify($contenu2);
		$data['contenu3'] = ControllerPageAdmin::simplify($contenu3);
		$data['titre1'] = ControllerPageAdmin::simplify($titre1);
		$data['titre2'] = ControllerPageAdmin::simplify($titre2);
		$data['titre3'] = ControllerPageAdmin::simplify($titre3);
		//Util::disp("data : ",$data);
		Model::update($data,$table_name,$primary_key);
		if ($nomPage == 'tarifsGites') {
			ModelGites::updateTarifs($tarifBS0,$tarifMS0,$tarifHS0,$tarifBS1,$tarifMS1,$tarifHS1,$tarifBS2,$tarifMS2,$tarifHS2);
		}
		ControllerPageAdmin::loadDefault();
	}

}