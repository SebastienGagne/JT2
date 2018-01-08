<?php

class ModelBaniere extends Model {

  protected static $object = 'baniere';
  protected static $primary = 'nomBaniere';
  protected $nomBaniere;
  protected $urlBaniere1;
  protected $urlBaniere2;
  protected $urlBaniere3;
  protected $urlBaniere4;

  public function __construct($nb = NULL, $u1 = NULL, $u2 = NULL, $u3 = NULL, $u4 = NULL) {
    if (!is_null($nb) && !is_null($u1) && !is_null($u2) && !is_null($u3) && !is_null($u4)) {
      $this->nomBaniere  = $nb;
      $this->urlBaniere1 = $u1;
      $this->urlBaniere2 = $u2;
      $this->urlBaniere3 = $u3;
      $this->urlBaniere4 = $u4;
    }
  }

}
?>
