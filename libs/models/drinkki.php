<?php
require_once 'libs/tietokantayhteys.php';
class Drinkki {
  
  private $drinkki_id;
  private $nimi;
  private $aliakset;
  private $drinkkityyppi;
  private $valmistustapa;
  
  public function __construct($drinkki_id, $nimi, $aliakset, $drinkkityyppi, $valmistustapa, $ainesosat, $virheet) {
    $this->drinkki_id = $drinkki_id;
    $this->nimi = $nimi;
    $this->aliakset = $aliakset;
    $this->drinkkityyppi = $drinkkityyppi;
    $this->valmistustapa = $valmistustapa;
    $this->virheet = $virheet;
  }

/* gettereitä ja settereitä */
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
public function getVirheet() {
    return $this->virheet;
}

public function setDrinkkiId($drinkki_id) {
    $this->drinkki_id = $drinkki_id;
}
public function setNimi($nimi) {
    $this->nimi = $nimi;
    if (trim($this->nimi) == '') {
        $this->virheet['nimi'] = "Nimessä täytyy olla merkkejä";
    } else {
        unset($this->virheet['nimi']);
    }
}
public function setAliakset($aliakset) {
    $this->aliakset = $aliakset;
    }
public function setDrinkkityyppi($drinkkityyppi) {
    $this->drinkkityyppi = $drinkkityyppi;
    }
public function setValmistustapa($valmistustapa) {
    $this->valmistustapa = $valmistustapa;
    }

 /* etsii drinkin tiedot postgresql-tietokannasta id-tunnuksen mukaan */
 function etsi($drinkki_id) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit WHERE drinkki_id = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($drinkki_id));
    $tulos = $kysely->fetchObject();
     $tulokset = array();
    if ($tulos == null) return null;
    else {
      $drinkki = new Drinkki($tulos->drinkki_id, $tulos->nimi, $tulos->aliakset,
        $tulos->drinkkityyppi, $tulos->valmistustapa);      
      $drinkki->setDrinkkiId($tulos->drinkki_id);
      $drinkki->setNimi($tulos->nimi);
      $drinkki->setAliakset($tulos->aliakset);
      $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
      $drinkki->setValmistustapa($tulos->valmistustapa);
      $tulokset[] = $drinkki;
      return $tulokset;}     
 }
  
  /* etsii drinkkiä nimeltä nimi- ja aliaskentistä (KESKENERÄINEN) */
  public static function etsiNimi($nimi) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit WHERE nimi = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($nimi));
    $tulos = $kysely->fetchObject();
     $tulokset = array();
    if ($tulos == null) {
        return null;
        }

    else {
      $drinkki = new Drinkki($tulos->drinkki_id, $tulos->nimi, $tulos->aliakset,
        $tulos->drinkkityyppi, $tulos->valmistustapa);      
        $drinkki->setDrinkkiId($tulos->drinkki_id);
        $drinkki->setNimi($tulos->nimi);
        $drinkki->setAliakset($tulos->aliakset);
        $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
        $drinkki->setValmistustapa($tulos->valmistustapa);
        $tulokset[] = $drinkki;
      return $tulokset;
    }
  }
  
  /* etsii kaikki reseptit tietokannasta ja palauttaa ne taulukkona */
  public static function etsiKaikkiDrinkit() {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit";
    $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
    
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $drinkki = new Drinkki();
        $drinkki->setDrinkkiId($tulos->drinkki_id);
        $drinkki->setNimi($tulos->nimi);
        $drinkki->setAliakset($tulos->aliakset);
        $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
        $drinkki->setValmistustapa($tulos->valmistustapa);

    //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
    //Se vastaa melko suoraan ArrayList:in add-metodia.
    $tulokset[] = $drinkki;
  }
  return $tulokset;
}

  /* getteri drinkkien lukumäärälle */
  public static function lukumaara() {
    $sql = "SELECT count(*) FROM drinkit";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }

  /* getteri näkymää varten, parametreinä sivunumero ja sivulla esitettävien
   * drinkkien lukumäärä
   */
  public static function getDrinkitSivulla ($sivu, $montako) {
    $sql = "SELECT * FROM drinkit ORDER by nimi LIMIT ? OFFSET ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($montako, ($sivu-1)*$montako));
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $drinkki = new Drinkki();
        $drinkki->setDrinkkiId($tulos->drinkki_id);
        $drinkki->setNimi($tulos->nimi);
        $drinkki->setAliakset($tulos->aliakset);
        $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
        $drinkki->setValmistustapa($tulos->valmistustapa);

    $tulokset[] = $drinkki;
  }
  return $tulokset;
  }
  
  /* lisää reseptin postgresql-tietokantaan, joka huolehtii drinkki_id-muuttujan 
     lisäämisestä */
  public function lisaaKantaan() {
    $sql = "INSERT INTO drinkit (nimi, aliakset, drinkkityyppi, valmistustapa) VALUES(?,?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa())); 
    if ($ok)  $this->drinkki_id = $kysely->fetchColumn();
    
    return $ok;
  }
   
    /* päivittää tietokantaan muutokset drinkki_id-indeksinumeron perusteella */
    public function muokkaaKantaa($drinkki_id) {
        $sql = "UPDATE drinkit SET nimi = ?, aliakset = ?, drinkkityyppi = ?, valmistustapa = ? WHERE drinkki_id = $drinkki_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa()));
        return $ok;
    }
   
   /* poistaa reseptin tietokannasta drinkki_id-indeksinumeron perusteella */
   public function poistaDrinkki($drinkki_id) {
    $sql = "DELETE FROM drinkit WHERE drinkki_id = $drinkki_id";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
  }
  
  /* Palauttaa true, jos drinkkiin syötetyt arvot ovat järkeviä. */
  public function onkoKelvollinen() {
    return empty($this->virheet);
  }
}