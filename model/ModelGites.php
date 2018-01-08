<?php

class ModelGites extends Model {

  public static function buildCalendar($gite,$mois,$an,$jour) {
    // calcul du mois suivant 
    $mois_suivant = $mois + 1;
    $an_suivant = $an;
    if ($mois_suivant == 13) {
      $mois_suivant = 1;
      $an_suivant = $an + 1;
    }
    
    // calcul du mois précédent
    $mois_prec = $mois - 1;
    $an_prec = $an;
    if ($mois_prec == 0) {
      $mois_prec = 12;
      $an_prec = $an - 1;
    }
    
    //affichage du mois et de l'année en french
    $mois_de_annee = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    $mois_en_clair = $mois_de_annee[$mois - 1];
    
    // creation d'un tableau à 31 entrées (1 pour chaque jour) - à ce stade aucun jour n'est resevé
    $tab_jours = array();
    for($j = 1; $j < 32; $j++) {
      $tab_jours[$j] = array(false,"");
    }
    
    // récupération des réservations pour le jour et le mois
    if (($gite == 'Banne') || ($gite == 'Sancy')) {
      $tab_Planning = ModelGites::getPlanning($gite,$mois,$an);
    } else {
      $tab_Planning = ModelGites::getPlanningGrandGite($mois,$an);
    }
    foreach ($tab_Planning as $ligne) {
      $jours = $ligne["jour"];
      // transforme aaaa/mm/jj en jj
      $jour_reserve = (int)substr($jours, 8, 2);
      // insertion des jours reservé dans le tableau
      $tab_jours[$jour_reserve] = array(true,$jours); 
    }
    //Util::disp("tab_jours",$tab_jours);
    // creation d'un tableau à 31 entrées (1 pour chaque jour) - pour les demandes
    $tab_dem = array();
    for($j = 1; $j < 32; $j++) {
      $tab_dem[$j] = array(false,"");
    }

    // récupération des demandes non traitées pour le jour et le mois
    $tab_Demandes= ModelReservation::recupererDemandes_M_A($gite,$mois,$an);
    foreach ($tab_Demandes as $ligne) {
      $jours = $ligne["jour"];
      // transforme aaaa/mm/jj en jj
      $jour_dem = (int)substr($jours, 8, 2);
      // insertion des jours reservé dans le tableau
      $tab_dem[$jour_dem] = array(true,$jours); 
    }
    //Util::disp("tab_dem",$tab_dem);
    
    //Détection du 1er et dernier jour du mois
    $nombre_date = mktime(0,0,0, $mois, 0, $an);
    $premier_jour = date('w', $nombre_date);
    $dernier_jour = 28;
    while (checkdate($mois, $dernier_jour + 1, $an)) $dernier_jour ++;
    
    // construction de l'affichage
    $aff = '<table align="center"  width="420" border="0" cellpadding="5" cellspacing="0"  class="tab_numero">
        <tr class="numero" align="center">';
    //Affichage de 7 jours du calendrier
    for ($i = 0; $i < 7; $i++){
      if ($i < $premier_jour){ 
        $aff .= '<td width="60"></td>';
      } else {
        $ce_jour = ($i+1) - $premier_jour;
        // si c'est un jour reserve on applique le style reserve
        if ($tab_jours[$ce_jour][0]) {
          if (Session::is_admin()) {
            //$aff .= '<td id="'.$ce_jour.'" width="60" class="reserve" title="éditer la résa" onclick="montrerResa('."'".$ce_jour."-".$mois."-".$an."'".');">';
            $aff .= '<td id="'.$ce_jour.'" width="60" class="reserve" title="éditer la résa">';
          } else {
            $aff .= '<td id="'.$ce_jour.'" width="60" class="reserve">';
          }   
        // si c'est un jour demandé on applique le style demande
        } else if ($tab_dem[$ce_jour][0] && Session::is_admin()) {
          $aff .= '<td id="'.$ce_jour.'" width="60" class="demande">';
        // sinon on ne met pas de style
        } else {
          $aff .= '<td class="libre" id="'.$ce_jour.'" width="60">';
        }
        if (($tab_jours[$ce_jour][0]) && (Session::is_admin())) {
          $aff .= '<a style="cursor:pointer;text-decoration:none;color:black;font-weight:bold;" href="index.php?controller=reservation&action=editerResa&mois='.$mois.'&an='.$an.'&gite='.$gite.'&jour='.$tab_jours[$ce_jour][1].'">'.$ce_jour.'</a>';
        } else {
          $aff .= $ce_jour;
        }
        $aff .= '</td>';
      }
    }
    //affichage du reste du calendrier
    $jour_suiv = ($i+1) - $premier_jour;
    for ($rangee = 0; $rangee <= 4; $rangee++){
        $aff .= '</tr>';
        $aff .= '<tr align="center" class="numero">';
        for ($i = 0; $i < 7; $i++){
          if($jour_suiv > $dernier_jour){ 
            $aff .= '<td width="60">';
            $aff .= '</td>';
          } else {
            // si c'est un jour reserve on applique le style reserve
            if ($tab_jours[$jour_suiv][0]) {
              if (Session::is_admin()) {
                //$aff .= '<td id="'.$jour_suiv.'" width="60" title="éditer la résa" class="reserve" onclick="montrerResa('."'".$jour_suiv."-".$mois."-".$an."'".');">';
                $aff .= '<td id="'.$jour_suiv.'" width="60" title="éditer la résa" class="reserve">';
              } else {
                $aff .= '<td class="reserve" id="'.$jour_suiv.'" width="60">';
              }
            // si c'est un jour demandé on applique le style demande
            } else if ($tab_dem[$jour_suiv][0] && Session::is_admin()) {
              $aff .= '<td id="'.$jour_suiv.'" width="60" class="demande">';
            // sinon on ne met pas de style
            } else {
              $aff .= '<td class="libre" id="'.$jour_suiv.'" width="60" >';
            }
            //echo $tab_jours[$jour_suiv];
            if (($tab_jours[$jour_suiv][0]) && (Session::is_admin())) {
              $aff .= '<a style="cursor:pointer;text-decoration:none;color:black;font-weight:bold;" href="index.php?controller=reservation&action=editerResa&mois='.$mois.'&an='.$an.'&gite='.$gite.'&jour='.$tab_jours[$jour_suiv][1].'">'.$jour_suiv.'</a>';
            } else {
              $aff .= $jour_suiv;
            }
            $aff .= '</td>';
          }
          $jour_suiv++;
        }
    }
    $aff .= '</tr></table>';

    $cal = array();
    $cal['affichage'] = $aff;
    $cal['mois'] = $mois;
    $cal['an'] = $an;
    $cal['mois_prec'] = $mois_prec;
    $cal['an_prec'] = $an_prec;
    $cal['mois_suivant'] = $mois_suivant;
    $cal['an_suivant'] = $an_suivant;
    $cal['mois_en_clair'] = $mois_en_clair;
    $lien_prec_non_admin = "<a href='index.php?controller=page&action=loadPlanning&gite=".$gite."&mois=".$mois_prec."&an=".$an_prec."'><div align='left'><img border='0' src='img/planning/prec.png'></div></a>";
    $lien_suiv_non_admin = "<a href='index.php?controller=page&action=loadPlanning&gite=".$gite."&mois=".$mois_suivant."&an=".$an_suivant."'><div><img border='0' src='img/planning/suiv.png'></div></a>";
    $lien_prec_gererDemandes = "<a href='index.php?controller=reservation&action=gererDemandes&gite=".$gite."&mois=".$mois_prec."&an=".$an_prec."'><div align='left'><img border='0' src='img/planning/prec.png'></div></a>";
    $lien_suiv_gererDemandes = "<a href='index.php?controller=reservation&action=gererDemandes&gite=".$gite."&mois=".$mois_suivant."&an=".$an_suivant."'><div><img border='0' src='img/planning/suiv.png'></div></a>";
    $lien_prec_creerResa = "<a href='index.php?controller=reservation&action=creerResa&gite=".$gite."&mois=".$mois_prec."&an=".$an_prec."'><div align='left'><img border='0' src='img/planning/prec.png'></div></a>";
    $lien_suiv_creerResa = "<a href='index.php?controller=reservation&action=creerResa&gite=".$gite."&mois=".$mois_suivant."&an=".$an_suivant."'><div><img border='0' src='img/planning/suiv.png'></div></a>";
    $lien_prec_editerResa = "<a href='index.php?controller=reservation&action=editerResa&gite=".$gite."&mois=".$mois_prec."&an=".$an_prec."&jour=".$jour."'><div align='left'><img border='0' src='img/planning/prec.png'></div></a>";
    $lien_suiv_editerResa = "<a href='index.php?controller=reservation&action=editerResa&gite=".$gite."&mois=".$mois_suivant."&an=".$an_suivant."&jour=".$jour."'><div><img border='0' src='img/planning/suiv.png'></div></a>";
    $table_entete_non_admin = 
      "<table align='center' width='420' border='0' cellpadding='5' cellspacing='0'  class='tab_cal'>
        <tr>
          <td height='51' colspan='7'>
            <table width='381' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='290' class='date'><div>".$mois_en_clair.' '.$an."</div></td>
                <td width='50'>".$lien_prec_non_admin."</td>
                <td width='41'>".$lien_suiv_non_admin."</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr align='center' class='jours'>
          <td width='60'>L</td>
          <td width='60'>M</td>
          <td width='60'>M</td>
          <td width='60'>J</td>
          <td width='60'>V</td>
          <td width='60'>S</td>
          <td width='60'>D</td>
        </tr>
      </table>";
    $table_entete_gererDemandes = 
      "<table align='center' width='420' border='0' cellpadding='5' cellspacing='0'  class='tab_cal'>
        <tr>
          <td height='51' colspan='7'>
            <table width='381' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='290' class='date'><div>".$mois_en_clair.' '.$an."</div></td>
                <td width='50'>".$lien_prec_gererDemandes."</td>
                <td width='41'>".$lien_suiv_gererDemandes."</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr align='center' class='jours'>
          <td width='60'>L</td>
          <td width='60'>M</td>
          <td width='60'>M</td>
          <td width='60'>J</td>
          <td width='60'>V</td>
          <td width='60'>S</td>
          <td width='60'>D</td>
        </tr>
      </table>";
    $table_entete_creerResa = 
      "<table align='center' width='420' border='0' cellpadding='5' cellspacing='0'  class='tab_cal'>
        <tr>
          <td height='51' colspan='7'>
            <table width='381' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='290' class='date'><div>".$mois_en_clair.' '.$an."</div></td>
                <td width='50'>".$lien_prec_creerResa."</td>
                <td width='41'>".$lien_suiv_creerResa."</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr align='center' class='jours'>
          <td width='60'>L</td>
          <td width='60'>M</td>
          <td width='60'>M</td>
          <td width='60'>J</td>
          <td width='60'>V</td>
          <td width='60'>S</td>
          <td width='60'>D</td>
        </tr>
      </table>";
    $table_entete_editerResa = 
      "<table align='center' width='420' border='0' cellpadding='5' cellspacing='0'  class='tab_cal'>
        <tr>
          <td height='51' colspan='7'>
            <table width='381' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='290' class='date'><div>".$mois_en_clair.' '.$an."</div></td>
                <td width='50'>".$lien_prec_editerResa."</td>
                <td width='41'>".$lien_suiv_editerResa."</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr align='center' class='jours'>
          <td width='60'>L</td>
          <td width='60'>M</td>
          <td width='60'>M</td>
          <td width='60'>J</td>
          <td width='60'>V</td>
          <td width='60'>S</td>
          <td width='60'>D</td>
        </tr>
      </table>";
    $cal['entete_non_admin'] = $table_entete_non_admin;
    $cal['entete_gererDemandes'] = $table_entete_gererDemandes;
    $cal['entete_creerResa'] = $table_entete_creerResa;
    $cal['entete_editerResa'] = $table_entete_editerResa;
    return $cal;
  }

  public static function getPlanning($gite,$mois,$annee) {
    $sql = "SELECT * FROM calendrier$gite WHERE YEAR(`jour`) = :annee_tag AND MONTH(`jour`) = :mois_tag AND etat = 1;";
    $req_prep = Model::$pdo->prepare($sql);
    $values = array(
      "mois_tag"  => $mois,
      "annee_tag" => $annee
    );
    $req_prep->execute($values);
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tab_Planning = $req_prep->fetchAll();
    return $tab_Planning;
  }

  public static function getPlanningGrandGite($mois,$annee) {
    // récupération des jours réservés du Sancy
    $tab_PlanningS = ModelGites::getPlanning('Sancy',$mois,$annee);
    // récupération des jours réservés de la Banne
    $tab_PlanningB = ModelGites::getPlanning('Banne',$mois,$annee);
    // construction d'un tableau avec les deux 
    $tab_PlanningGG = array();
    foreach ($tab_PlanningS as $key => $value) {
      $tab_PlanningGG[] = $value;
    }
    foreach ($tab_PlanningB as $key => $value) {
      $tab_PlanningGG[] = $value;
    }
    return $tab_PlanningGG;
  }

  public static function getTarifGites() {
    $sql = "SELECT * FROM JT_TarifsGites ORDER BY `tarifBS`";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tab_TarifGites = $req_prep->fetchAll();
    return $tab_TarifGites;
  }

  public static function updateTarifs($tarifBS0,$tarifMS0,$tarifHS0,$tarifBS1,$tarifMS1,$tarifHS1,$tarifBS2,$tarifMS2,$tarifHS2) {
    $sql0 = "UPDATE `JT_TarifsGites` SET `tarifBS` = ".$tarifBS0.",`tarifMS` = ".$tarifMS0.",`tarifHS` = ".$tarifHS0." WHERE `gite`= 'la Banne'";
    $req_prep = Model::$pdo->prepare($sql0); 
    $req_prep->execute();
    $sql1 = "UPDATE `JT_TarifsGites` SET `tarifBS` = ".$tarifBS1.",`tarifMS` = ".$tarifMS1.",`tarifHS` = ".$tarifHS1." WHERE `gite`= 'le Sancy'";
    $req_prep = Model::$pdo->prepare($sql1); 
    $req_prep->execute();
    $sql2 = "UPDATE `JT_TarifsGites` SET `tarifBS` = ".$tarifBS2.",`tarifMS` = ".$tarifMS2.",`tarifHS` = ".$tarifHS2." WHERE `gite`= 'Banne-Sancy'";
    $req_prep = Model::$pdo->prepare($sql2); 
    $req_prep->execute();
  }

}
?>
