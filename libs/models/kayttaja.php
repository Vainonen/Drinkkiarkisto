<?php
require_once 'libs/tietokantayhteys.php';
class Kayttaja {
  
  private $kayttaja_id;
  private $tunnus;
  private $salasana;
  private $muokkausoikeus;
  private $adminoikeus;
  private $virheet;
  
  public function __construct($id, $tunnus, $salasana, $muokkausoikeus, $adminoikeus) {
$this->id = $id;
$this->tunnus = $tunnus;
$this->salasana = $salasana;
$this->muokkausoikeus = $muokkausoikeus;
$this->adminoikeus = $adminoikeus;
}

/* gettereitä ja settereitä 
 * HUOM! VIRHEIDEN TARKISTUS PUUTTUU!
 */
public function getId() {
return $this->kayttaja_id;
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
public function geVirheet() {
return $this->virheet;
}

public function setId($kayttaja_id) {
$this->kayttaja_id = $kayttaja_id;
}
public function setTunnus($tunnus) {
$this->tunnus = $tunnus;
}
public function setSalasana($salasana) {
$this->salasana = $salasana;
}
public function setMuokkausoikeus($muokkausoikeus) {
$this->muokkausoikeus = $muokkausoikeus;
}
public function setAdminoikeus($adminoikeus) {
$this->adminoikeus = $adminoikeus;
}
public function setVirheet($virheet) {
$this->virheet = $virheet;
}

  /* etsii käyttäjän käyttäjätunnuksen ja salasanan mukaan */
  public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
    $sql = "SELECT kayttaja_id, tunnus, salasana, muokkausoikeus, adminoikeus FROM kayttajat WHERE tunnus = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));

    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
      return null;
    } else {
      $kayttaja = new Kayttaja(); 
      $kayttaja->setId($tulos->kayttaja_id);
      $kayttaja->setTunnus($tulos->tunnus);
      $kayttaja->setSalasana($tulos->salasana);
      $kayttaja->setMuokkausoikeus($tulos->muokkausoikeus);
      $kayttaja->setAdminoikeus($tulos->adminoikeus);
      return $kayttaja;
    }
  }
     
   /* getteri näkymää varten, parametreinä sivunumero ja sivulla esitettävien
   * käyttäjien lukumäärä
   */
  public static function getKayttajatSivulla ($sivu, $montako) {
    $sql = "SELECT * FROM kayttajat ORDER by tunnus LIMIT ? OFFSET ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($montako, ($sivu-1)*$montako));
    $tulokset = array();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
        $kayttaja = new Kayttaja();
        $kayttaja->setId($tulos->kayttaja_id);
        $kayttaja->setTunnus($tulos->tunnus);
        $kayttaja->setSalasana($tulos->salasana);
        $kayttaja->setMuokkausoikeus($tulos->muokkausoikeus);
        $kayttaja->setAdminoikeus($tulos->adminoikeus);

    $tulokset[] = $kayttaja;
  }
  return $tulokset;
  }
  
  /* getteri käyttäjien lukumäärälle */
  public static function lukumaara() {
    $sql = "SELECT count(*) FROM kayttajat";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }
    
  /* etsii kaikki käyttäjät ja palauttaa ne taulukkona */
  public static function etsiKaikkiKayttajat() {
  $sql = "SELECT kayttaja_id, tunnus, salasana, muokkausoikeus, adminoikeus FROM kayttajat";
  $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
    
  $tulokset = array();
  foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $kayttaja = new Kayttaja();
    $kayttaja->setId($tulos->kayttaja_id);
    $kayttaja->setTunnus($tulos->tunnus);
    $kayttaja->setSalasana($tulos->salasana);
    $kayttaja->setMuokkausoikeus($tulos->muokkausoikeus);
    $kayttaja->setAdminoikeus($tulos->adminoikeus);

    $tulokset[] = $kayttaja;
  }
  return $tulokset;
}

  /* käyttäjän rekisteröitymistä varten:
   * tarkistaa ensin, ettei samaa tunnusta löydy tietokannasta (KESKENERÄINEN)
   */
  public function lisaaKantaan($kayttaja) {
    $sql = "SELECT kayttaja_id, tunnus, salasana, muokkausoikeus, adminoikeus from kayttajat where tunnus = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));
    $tulos = $kysely->fetchObject();
    if ($tulos != null) return false;
    else {
    $sql = "INSERT INTO kayttaja (tunnus, salasana, muokkausoikeus, adminoikeus) VALUES(?,?,false,false)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($this->getTunnus(), $this->getSalasana(), $this->getMuokkausoikeus(), $this->getAdminoikeus())); 
    if ($ok)  $this->drinkki_id = $kysely->fetchColumn();
    
    return $ok;
    }
  }
   
    /* päivittää tietokantaan moderointi- ja reseptimuokkausoikeuksen muutokset (KESKENERÄINEN)
     * HUOM! PITÄÄ LISÄTÄ TARKISTUS, ETTÄ MODERAATTORI EI VOI POISTAA OMIA OIKEUKSIAAN!
     */
    public function annaMuokkausoikeudet($kayttaja_id) {
        $sql = "UPDATE kayttajat SET tunnus = ?, salasana = ?, muokkausoikeus = ?, adminoikeus = ? WHERE kayttaja_id = $kayttaja_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getTunnus(), $this->getSalasana(), $this->getMuokkausoikeus(), $this->getAdminoikeus()));
        return $ok;
    }
    
    /* metodi vaihtaa salasanan, joka moderaattorin tai käyttäjän kutsumana (KESKENERÄINEN) */
    public function vaihdaSalasanaa($kayttaja_id) {
        $sql = "UPDATE kayttajat SET salasana = ? WHERE kayttaja_id = $kayttaja_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getTunnus(), $this->getSalasana(), $this->getMuokkausoikeus(), $this->getAdminoikeus()));
        return $ok;
    }
   
   /* metodi poistaa käyttäjätiedot, joka moderaattorin tai käyttäjän kutsumana (KESKENERÄINEN)*/
   public function poistaKayttaja($kayttaja_id) {
    $sql = "DELETE FROM kayttajat WHERE kayttaja_id = $kayttaja_id";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
  }
  
  /* Palauttaa true, jos käyttäjätietoihin syötetyt arvot ovat järkeviä. */
  public function onkoKelvollinen() {
    return empty($this->virheet);
  }
  
}