<?php

class ModelSupplements extends Model {

  public static function getTarifsSupplements() {
    $sql = "SELECT * FROM JT_TarifsSupplements";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tab_TarifsSupplements = $req_prep->fetchAll();
    return $tab_TarifsSupplements;
  }

  public static function getSupplementsOfferts() {
    $sql = "SELECT * FROM JT_TarifsSupplements WHERE `prixUnique` = 1 AND `prixBanne` = 0";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tab_SupplementsOfferts = $req_prep->fetchAll();
    return $tab_SupplementsOfferts;
  }

  public static function getSupplementsTarifUnique() {
    $sql = "SELECT * FROM JT_TarifsSupplements WHERE `prixUnique` = 1 AND `prixBanne` > 0";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tab_SupplementsTarifUnique = $req_prep->fetchAll();
    return $tab_SupplementsTarifUnique;
  }

}
?>
