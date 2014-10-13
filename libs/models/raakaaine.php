<?php
require_once 'libs/tietokantayhteys.php';
class Raakaaine {
  
  private $raakaaine_id;
  private $nimi;
  private $tilavuus;
  private $virheet;
       
/* Kirjoita tähän gettereitä ja settereitä */
public function getAineId() {
    return $this->raakaaine_id;
}
public function getNimi() {
    return $this->nimi;
}
public function getTilavuus() {
    return $this->tilavuus;
}
public function getVirheet() {
    return $this->virheet;
}

public function setAineId($raakaaine_id) {
    if (empty($raakaaine_id)) $this->virheet['raakaaine'] = "Raaka-aineella on annettava nimi!";
    $this->raakaaine_id = $raakaaine_id;
}
public function setNimi($nimi) {
    $this->nimi = $nimi;
}
public function setTilavuus($tilavuus) {
    $this->tilavuus = $tilavuus;
    if (!is_numeric($tilavuus)) $this->virheet['tilavuus'] = "Tilavuuden täytyy olla numero, käytä pistettä desimaaliluvuissa!";
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

  /* etsii drinkin ainesosat Aines-osat välitaulusta */
  public static function etsiAinesosat($drinkki_id) {
    $sql = "SELECT tilavuus, raakaaineet.nimi, raakaaineet.raakaaine_id "
            . "FROM ainesosat JOIN drinkit ON drinkit.drinkki_id=ainesosat.drinkki_id JOIN raakaaineet ON raakaaineet.raakaaine_id=ainesosat.raakaaine_id "
            . "WHERE ainesosat.drinkki_id=?";
    $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute(array($drinkki_id));
    
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $ainesosa = new Raakaaine();
        $ainesosa->setTilavuus($tulos->tilavuus);
        $ainesosa->setAineId($tulos->raakaaine_id);
        $ainesosa->setNimi($tulos->nimi);
 
    $tulokset[] = $ainesosa;
  }
  return $tulokset;
}
  
  /* laskee yhden drinkin ainesosien lukumäärän */
  public static function lukumaara($drinkki_id) {
    $sql = "SELECT count(*) FROM ainesosat WHERE drinkki_id = $drinkki_id";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }

  /* lisää yhden aineksen Ainesosat-välitauluun, parametriksi pitää antaa drinkki- ja raakaaine-taulukkojen id-tunnus */
  public function lisaaAineJuomaan($drinkki_id, $raakaaine_id) {
    $sql = "INSERT INTO ainesosat (tilavuus, drinkki_id, raakaaine_id) VALUES(?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($this->getTilavuus(), $drinkki_id, $raakaaine_id)); 
    
    return $ok;
  }
  
   /* päivittää Ainesosat-välitauluun muutokset, parametriksi pitää antaa drinkki- ja raakaaine-taulukkojen id-tunnus */
    public function muokkaaKantaa($drinkki_id, $raakaaine_id) {
        $sql = "UPDATE ainesosat SET tilavuus = ?, drinkki_id = ?, raakaaine_id = ? WHERE drinkki_id = $drinkki_id, raakaaine_id = $raakaaine_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getTilavuus(), $drinkki_id, $raakaaine_id)); 
        return $ok;
    }
   
   /* poistaa ainesosat drinkistä drinkki_id-indeksinumeron perusteella */
   public function poistaAinesosat ($drinkki_id) {
    $sql = "DELETE FROM ainesosat WHERE drinkki_id = $drinkki_id";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
  }
  
  /* Palauttaa true, jos drinkkiin syötetyt arvot ovat järkeviä. */
  public function onkoKelvollinen() {
    return empty($this->virheet);
  }
}