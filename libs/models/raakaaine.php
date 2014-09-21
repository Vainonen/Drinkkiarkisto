<?php
require_once 'libs/tietokantayhteys.php';
class Raakaaine {
  
  private $aine_id;
  private $nimi;

 
  public function __construct($aine_id, $nimi) {
    $this->aine_id = $aine_id;
    $this->nimi = $nimi;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getAineId() {
return $this->aine_id;
}
public function getNimi() {
return $this->nimi;
}


public function setAineId($id) {
$this->aine_id = $aine_id;
}
public function setNimi($nimi) {
$this->nimi = $nimi;
}
}