<?php
require_once 'libs/tietokantayhteys.php';
class Raakaaine {
  
  private $id;
  private $nimi;

 
  public function __construct($id, $nimi) {
    $this->id = $id;
    $this->nimi = $nimi;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getAineId() {
return $this->id;
}
public function getNimi() {
return $this->nimi;
}


public function setAineId($id) {
$this->id = $id;
}
public function setNimi($nimi) {
$this->nimi = $nimi;
}
}