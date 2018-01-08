<?php

class ModelReservation extends Model {

	public static function insertionDemande($gite,$etat,$jourArrivee,$jourDepart,$nom,$prenom,$email,$telephone,$adresse,$codepostal,$ville,$pays,$message) {
    	$tabjourArrivee = explode("-",$jourArrivee);
    	$jour_Arrivee = $tabjourArrivee[2]."-".$tabjourArrivee[1]."-".$tabjourArrivee[0];
    	$tabjourDepart = explode("-",$jourDepart);
    	$jour_Depart = $tabjourDepart[2]."-".$tabjourDepart[1]."-".$tabjourDepart[0];
    	$Date1 = new DateTime($jour_Depart);
    	$Date2 = new DateTime($jour_Arrivee);
    	$nbj = $Date1->diff($Date2)->days;
    	$calendrier = "calendrier$gite";
    	$id = uniqid();
    	// vérifier lors du transfert que l'AUTO-INCREMENT `num` passe bien
    	$sql = "INSERT INTO $calendrier(`num`,`id`,  `etat`, `jour`, `nbjours`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `codepostal`, `ville`, `pays`, `message`) VALUES (:num_tag, :id_tag, :etat_tag, :jour_tag, :nbjours_tag, :nom_tag, :prenom_tag, :email_tag, :telephone_tag, :adresse_tag, :codepostal_tag, :ville_tag, :pays_tag, :message_tag);";
    	$req_prep = Model::$pdo->prepare($sql);
  
    	$jour = $Date2;
    	$texteJour = $jour_Arrivee;

    	for ($i = 0; $i < $nbj; $i++) { 
      		$values = array(
      			"num_tag"		  => '',
		        "id_tag"          => $id,
		        "etat_tag"        => $etat,
		        "jour_tag"        => $texteJour,
		        "nbjours_tag"     => $nbj,
		        "nom_tag"         => $nom,
		        "prenom_tag"      => $prenom,
		        "email_tag"       => $email,
		        "telephone_tag"   => $telephone,
		        "adresse_tag"     => $adresse,
		        "codepostal_tag"  => $codepostal,
		        "ville_tag"       => $ville,
		        "pays_tag"        => $pays,
		        "message_tag"     => $message
	      	);
	      	$req_prep->execute($values);
	      	$jour->add(new DateInterval('P1D'));
	      	$texteJour = $jour->format('Y-m-d');
    	}
  	}

  	public static function insertionResaManuelle($gite,$jourArrivee,$jourDepart,$nom,$prenom,$email,$telephone,$adresse,$codepostal,$ville,$pays,$message) {
    	//
    	ModelReservation::insertionDemande($gite,1,$jourArrivee,$jourDepart,$nom,$prenom,$email,$telephone,$adresse,$codepostal,$ville,$pays,$message);
  	}

  	public static function idDemandes($gite,$etat) {
  		$sql = "SELECT DISTINCT id FROM calendrier$gite WHERE etat = $etat;";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab_id = $req_prep->fetchAll();
		return $tab_id;
	}

	public static function recupererDemandes($gite,$etat) {
		$sql = "SELECT * FROM calendrier$gite WHERE etat = $etat;";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab_Planning = $req_prep->fetchAll();
		return $tab_Planning;
	}

	public static function recupererDemandes_M_A($gite,$mois,$an) {
		$sql = "SELECT * FROM calendrier$gite WHERE YEAR(`jour`) = :annee_tag AND MONTH(`jour`) = :mois_tag AND etat = 0;";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
      		"mois_tag"  => $mois,
      		"annee_tag" => $an
    	);
    	$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab_Dem = $req_prep->fetchAll();
		//echo "<pre>";print_r($tab_Dem);echo "</pre>";
		return $tab_Dem;
	}

	public static function demande($gite,$etat,$id) {
		$sql = "SELECT * FROM calendrier$gite WHERE etat = '$etat' AND id = '$id';";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab_Planning = $req_prep->fetchAll();
		return $tab_Planning[0];
	}

	public static function getResaByJour($gite,$jour) {
		$sql = "SELECT * FROM calendrier$gite WHERE jour = '$jour';";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
		$req_prep->setFetchMode(PDO::FETCH_ASSOC);
		$tab_Planning = $req_prep->fetchAll();
		return $tab_Planning[0];
	}

	public static function classerDemande($gite,$id,$etat) {
		$sql = "UPDATE calendrier$gite SET etat = :etat_tag WHERE id = :id_tag;";
		$req_prep = Model::$pdo->prepare($sql); 
		$values = array(
			"etat_tag"       => $etat,
			"id_tag"         => $id
		);
		$req_prep->execute($values);
	}

	public static function deleteReservation($gite,$num) {
		$sql = "DELETE from calendrier$gite WHERE num = :num_tag";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"num_tag" => $num
		);
		$req_prep->execute($values); 
	}

	public static function deleteAllResaByJour($gite,$id) {
 		$sql = "DELETE from calendrier$gite WHERE id = :id_tag";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"id_tag" => $id
		);
		$req_prep->execute($values);
	}

	public static function deleteResaByJour($gite,$jour) {
		$sql = "DELETE from calendrier$gite WHERE jour = :jour_tag";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"jour_tag" => $jour
		);
		$req_prep->execute($values); 
	}

	public static function formulaireResa() {
		$form = '<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>date d\'arrivée *</label>
					<input name="jourArrivee" id="j1" type="text" class="datepicker" required>
				</div>
				<div class="itemLigneResa">
					<label>date de départ *</label>
					<input name="jourDepart" id="j2" type="text" class="datepicker" required>
				</div>
			</div>
			<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>nom *</label>
					<input name="nom" id="nom" type="text" required>
				</div>
				<div class="itemLigneResa">
					<label>prénom *</label>
					<input name="prenom" id="prenom" type="text" required>
				</div>
			</div>
			<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>numéro de téléphone *</label>
					<input name="telephone" id="telephone" type="text" required>
				</div>
				<div class="itemLigneResa">
					<label>e-mail *</label>
					<input name="mail" id="mail" type="email" required>
				</div>
			</div>
			<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>adresse *</label>
					<input name="adresse" id="adresse" type="text" required>
				</div>
				<div class="itemLigneResa">
					<label>code postal *</label>
					<input name="cp" id="cp" type="text" required><br>
				</div>
			</div>
			<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>ville *</label>
					<input name="ville" id="ville" type="text" required>
				</div>
				<div class="itemLigneResa">
					<label>pays *</label>
					<input name="pays" id="pays" type="pays" required>
				</div>
			</div>
			<div class="ligneFormulaireResa">
				<div class="itemLigneResa">
					<label>message éventuel</label>
					<textarea id="message" name="message" placeholder="votre message" maxlength="500" rows="5" cols="100" class="message" style="width:100%;border-radius:7px;border:solid 2px lightgrey;"></textarea>
				</div>
			</div>';
		return $form;
	}

	public static function afficherResa($resa) {
		if (sizeof($resa) > 0) {
			$aff  = "<h3>réservation sélectionnée :</h3>";
			$aff .= "- nom, prénom : ".$resa['nom']." ".$resa['prenom']."<br>";
			$aff .= "- adresse     : ".$resa['adresse']." ".$resa['codepostal']." ".$resa['ville']."<br>";
			$aff .= "- arrivée     : ".$resa['jour']."<br>";
			$aff .= "- durée       : ".$resa['nbjours']." nuitées.<br>";
			$aff .= "- téléphone   : ".$resa['telephone']."<br>";
			$aff .= "- email       : <a href='mailto:".$resa['email']."'>".$resa['email']."</a><br>";
			$aff .= "- message     : ".$resa['message']."<br>";
		} else {
			$aff = "";
		}
		return $aff;
	}

}

?>