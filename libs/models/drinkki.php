<?php
require_once 'libs/tietokantayhteys.php';
class Drinkki {
  
  private $id;
  private $nimi;
  private $aliakset;
  private $drinkkityyppi;
  private $valmistustapa;
  private $virheet;
       
  public function __construct($id, $nimi, $aliakset, $drinkkityyppi, $valmistustapa, $virheet) {
    $this->id = $id;
    $this->nimi = $nimi;
    $this->aliakset = $aliakset;
    $this->drinkkityyppi = $drinkkityyppi;
    $this->valmistustapa = $valmistustapa;
    $this->virheet = $virheet;
  }

/* Kirjoita tähän gettereitä ja settereitä */
public function getDrinkkiId() {
    return $this->id;
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

public function setDrinkkiId($id) {
    $this->id = $id;
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



 function etsi($id) {
    $sql = "SELECT id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit WHERE id = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($id));
    $tulos = $kysely->fetchObject();
     $tulokset = array();
    if ($tulos == null) {
        return null;
        }
    else {
      $drinkki = new Drinkki($tulos->id, $tulos->nimi, $tulos->aliakset,
        $tulos->drinkkityyppi, $tulos->valmistustapa);      
      $drinkki->setDrinkkiId($tulos->id);
      $drinkki->setNimi($tulos->nimi);
      $drinkki->setAliakset($tulos->aliakset);
      $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
      $drinkki->setValmistustapa($tulos->valmistustapa);
      $tulokset[] = $drinkki;
      return $tulokset;
    }
        
 }
        
  public static function etsiNimi($nimi) {
    $sql = "SELECT id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit WHERE nimi = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($nimi));
    $tulos = $kysely->fetchObject();
     $tulokset = array();
    if ($tulos == null) {
        return null;
        }

    else {
      $drinkki = new Drinkki($tulos->id, $tulos->nimi, $tulos->aliakset,
        $tulos->drinkkityyppi, $tulos->valmistustapa);      
        $drinkki->setDrinkkiId($tulos->id);
        $drinkki->setNimi($tulos->nimi);
        $drinkki->setAliakset($tulos->aliakset);
        $drinkki->setDrinkkityyppi($tulos->drinkkityyppi);
        $drinkki->setValmistustapa($tulos->valmistustapa);
        $tulokset[] = $drinkki;
      return $tulokset;
    }
  }
  
  public static function etsiKaikkiDrinkit() {
    $sql = "SELECT id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit";
    $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
    
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $drinkki = new Drinkki();
        $drinkki->setDrinkkiId($tulos->id);
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

  public static function haeRivi() {
  $sql = "SELECT id, nimi, aliakset, drinkkityyppi, 
          valmistustapa FROM drinkit";
  $kysely = getTietokantayhteys()->prepare($sql);
    $assosiaatiotaulu = $kysely->fetch();
    echo $assosiaatiotaulu['nimi']; 
  }
  
  public static function lukumaara() {
    $sql = "SELECT count(*) FROM drinkit";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }

  public static function getDrinkitSivulla ($sivu, $montako) {
    $sql = "SELECT * FROM drinkit ORDER by nimi LIMIT ? OFFSET ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($montako, ($sivu-1)*$montako));
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $drinkki = new Drinkki();
        $drinkki->setDrinkkiId($tulos->id);
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
  
  public function lisaaKantaan() {
    $sql = "INSERT INTO drinkit (nimi, aliakset, drinkkityyppi, valmistustapa) VALUES(?,?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql);
    
    $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa()));
    
    if ($ok) {
      //Haetaan RETURNING-määreen palauttama id.
      //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
      $this->id = $kysely->fetchColumn();
    }
    return $ok;
  }
  
    public function muokkaaKantaa($id) {
    $sql = "UPDATE drinkit SET nimi = ?, aliakset = ?, drinkkityyppi = ?, valmistustapa = ? WHERE id = $id";
    $kysely = getTietokantayhteys()->prepare($sql);
    
    $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa()));
 
    return $ok;
  }
   public function poistaDrinkki($id) {
    $sql = "DELETE FROM drinkit WHERE id = $id";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
  }
  
  /* Palauttaa true, jos drinkkiin syötetyt arvot ovat järkeviä. */
  public function onkoKelvollinen() {
    return empty($this->virheet);
  }
}