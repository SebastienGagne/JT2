<?php

class ModelPage extends Model {

  protected static $object = 'page';
  protected static $primary = 'nomPage';
  protected $nomPage;
  protected $title;
  protected $titre1;
  protected $titre2;
  protected $titre3;
  protected $contenu1;
  protected $contenu2;
  protected $contenu3;
  protected $urlPhoto1;
  protected $urlPhoto2;
  protected $urlPhoto3;
  protected $urlPhoto4;
  protected $urlPhoto5;
  protected $urlPhoto6;

  public function __construct($np = NULL, $tl = NULL, $t1 = NULL, $t2 = NULL, $t3 = NULL, $c1 = NULL, $c2 = NULL, $c3 = NULL, $ug1 = NULL, $ug2 = NULL, $ug3 = NULL, $ud1 = NULL, $ud2 = NULL, $ud3 = NULL) {
    if (!is_null($np) && !is_null($tl) && !is_null($t1) && !is_null($t2) && !is_null($t3) && !is_null($c1) && !is_null($c2) && !is_null($c3) && !is_null($ug1) && !is_null($ug2) && !is_null($ug3) && !is_null($ud1) && !is_null($ud2) && !is_null($ud3)) {
      $this->nomPage = $np;
      $this->title = $tl;
      $this->titre1 = $t1;
      $this->titre2 = $t2;
      $this->titre3 = $t3;
      $this->contenu1 = $c1;
      $this->contenu2 = $c2;
      $this->contenu3 = $c3;
      $this->urlPhotoG1 = $ug1;
      $this->urlPhotoG2 = $ug2;
      $this->urlPhotoG3 = $ug3;
      $this->urlPhotoD1 = $ud1;
      $this->urlPhotoD2 = $ud2;
      $this->urlPhotoD3 = $ud3;
    }
  }

}
?>
