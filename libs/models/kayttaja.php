<?php
require_once 'libs/tietokantayhteys.php';
class Kayttaja {
  
  private $id;
  private $tunnus;
  private $salasana;
  private $muokkausoikeus;
  private $adminoikeus;
  
  public function __construct($id, $tunnus, $salasana) {
    $this->id = $id;
    $this->tunnus = $tunnus;
    $this->salasana = $salasana;
    $this->muokkausoikeus = muokkausoikeus;
    $this->adminoikeus = adminoikeus;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getId() {
return $this->id;
}
public function getTunnus() {
return $this->tunnus;
}
public function getSalasana() {
return $this->salasana;
}
public function getMuokkausoikeus() {
return $this->muokkausoikeus;
}
public function getAdminoikeus() {
return $this->adminoikeus;
}

public function setId($id) {
$this->id = $id;
}
public function setTunnus($tunnus) {
$this->tunnus = $tunnus;
}
public function setSalasana($salasana) {
$this->salasana = $salasana;
}
public function setMuokkausoikeus() {
$this->muokkausoikeus = $muokkausoikeus;
}
public function setAdminoikeus() {
$this->adminoikeus = $adminoikeus;
}

  public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
    $sql = "SELECT id, tunnus, salasana from kayttajat where tunnus = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));

    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
      return null;
    } else {
      $kayttaja = new Kayttaja(); 
      $kayttaja->setId($tulos->id);
      $kayttaja->setTunnus($tulos->tunnus);
      $kayttaja->setSalasana($tulos->salasana);

      return $kayttaja;
    }
  }
}