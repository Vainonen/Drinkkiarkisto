<?php
require_once 'libs/tietokantayhteys.php';
class Raakaaine {
  
  private $raakaaine_id;
  private $nimi;
  private $tilavuus;
  private $virheet;
       
 
  public function __construct($tilavuus, $raakaaine_id, $nimi) {
    $this->tilavuus = $tilavuus;
    $this->raakaaine_id = $raakaaine_id;
    $this->nimi = $nimi;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getAineId() {
return $this->raakaaine_id;
}
public function getNimi() {
return $this->nimi;
}
public function getAinesosat() {
    return $this->ainesosat;
}
public function getVirheet() {
    return $this->virheet;
}
public function getTilavuus() {
    return $this->ainesosat;
}
public function getAinesosa() {
    return $this->ainesosat;
}

public function setAineId($raakaaine_id) {
$this->raakaaine_id = $raakaaine_id;
}
public function setNimi($nimi) {
$this->nimi = $nimi;
}

  /* Etsii listan kaikista raaka-aineista, navigaatiopalkin 
   * Ainesosat-listausnäkymää varten
   */
  public static function etsiKaikkiRaakaaineet() {
    $sql = "SELECT raakaaine_id, nimi FROM raakaaineet";
    $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
    
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $raakaaine = new Raakaaine();
        $raakaaine->setAineId($tulos->raakaaine_id);
        $raakaaine->setNimi($tulos->nimi);

    //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
    //Se vastaa melko suoraan ArrayList:in add-metodia.
    $tulokset[] = $raakaaine;
  }
  return $tulokset;
}

  /* etsii drinkin ainesosat Aines-osat välitaulusta (KESKENERÄINEN) */
  public static function etsiAinesosat($kohde_id) {
    $sql = "SELECT tilavuus, raakaaineet.nimi FROM ainesosat
            JOIN drinkit ON drinkit.drinkki_id=ainesosat.kohde_id 
            JOIN raakaaineet ON raakaaineet.raakaaine_id=ainesosat.aine_id WHERE ainesosat.kohde_id=?";
    $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
    
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $drinkki = new Raakaaine();
        $drinkki->setTilavuus($tulos->tilavuus);
        $drinkki->setNimi($tulos->nimi);
        $drinkki->setAliakset($tulos->aliakset);
        $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
        $drinkki->setValmistustapa($tulos->valmistustapa);
    $tulokset[] = $drinkki;
  }
  return $tulokset;
}

  /* lisää yhden aineksen Ainesosat-välitauluun (KESKENERÄINEN) */
  public function lisaaAineJuomaan() {
  $sql = "INSERT INTO ainesosat (tilavuus, kohde_id, aine_id) VALUES(?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa())); 
    if ($ok)  $this->drinkki_id = $kysely->fetchColumn();
    
    return $ok;
  }

}