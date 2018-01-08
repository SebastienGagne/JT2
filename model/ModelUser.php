<?php

class ModelUser extends Model {

  protected static $object = 'user';
  protected static $primary = 'login';
  protected $login;
  protected $mdp;
  protected $isAdmin;
  protected $email;
  protected $nonce;

  public function __construct($l = NULL, $m = NULL, $i = NULL, $e = NULL, $n = NULL) {
    if (!is_null($l) && !is_null($m) && !is_null($i) && !is_null($e) && !is_null($n)) {
      $this->login = $l;
      $this->mdp = $m;
      $this->isAdmin = $i;
      $this->email = $e;
      $this->nonce = $n;
    }
  }

  public static function checkPassword($login,$mot_de_passe_chiffre) {
    $sql = "SELECT * FROM user WHERE login = '".$login."' AND mdp = '".$mot_de_passe_chiffre."';";
    try {
      $rep = Model::$pdo->query($sql);
      $tab = $rep->fetchAll();
      return (sizeof($tab) == 1);
    } catch(PDOexception $e) {
      echo "<pre>";print_r($e->errorInfo);echo "</pre>";
      return false;
    }
  }

  public static function setNonceNULL($login) {
    $sql = "UPDATE `user` SET `nonce` = NULL WHERE login = '".$login."';";
    //echo $sql;
    try {
      $rep = Model::$pdo->query($sql);
      $rep->execute();
      // à adapter :
      //echo "votre inscription est confirmée. Vous pouvez maintenant vous <a href='http://webinfo.iutmontp.univ-montp2.fr/~etugagne/PHP/TD8/index.php?action=connect&controller=utilisateur'>connecter</a>.";
      return true;
    } catch(PDOexception $e) {
      echo "<pre>";print_r($e->errorInfo);echo "</pre>";
      return false;
    }
  }




}
?>
