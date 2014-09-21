<?php
require_once 'libs/tietokantayhteys.php';
class Kayttaja {
  
  private $drinkki_id;
  private $nimi;
  private $aliakset;
  private $drinkkityyppi;
  private $valmistustapa;
       
  public function __construct($drinkki_id, $nimi, $aliakset, $drinkkityyppi, $valmistustapa) {
    $this->drinkki_id = $drinkki_id;
    $this->nimi = $nimi;
    $this->aliakset = $aliakset;
    $this->drinkkityyppi = $drinkkityyppi;
    $this->valmistustapa = $valmistustapa;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getDrinkkiId() {
return $this->drinkki_id;
}
public function getNimi() {
return $this->nimi;
}
public function getAliakset() {
return $this->aliakset;
}
public function getDrinkkityyppi() {
return $this->drinkkityyppi;
}
public function getValmistustapa() {
return $this->valmistustapa;
}

public function setDrinkkiId($id) {
$this->drinkki_id = $drinkki_id;
}
public function setNimi($nimi) {
$this->nimi = $nimi;
}
public function setAliakset($aliakset) {
$this->aliakset = $aliakset;
}
public function setDrinkkityyppi() {
$this->drinkkityyppi = $drinkkityyppi;
}
public function setValmistustapa() {
$this->valmistustapa = $valmistustapa;
}
}