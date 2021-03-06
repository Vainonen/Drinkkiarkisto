<?php
require_once 'libs/tietokantayhteys.php';
class Kayttaja {
  
  private $kayttaja_id;
  private $tunnus;
  private $salasana;
  private $muokkausoikeus; // integer-arvo 0 tai 1 totuusarvona
  private $adminoikeus;    // integer-arvo 0 tai 1 totuusarvona
  private $virheet;
  
/* gettereitä ja settereitä */
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
public function getVirheet() {
    return $this->virheet;
}

public function setId($kayttaja_id) {
    $this->kayttaja_id = $kayttaja_id;
}
public function setTunnus($tunnus) {
    if (Kayttaja::onkoTunnusta($tunnus)) $this->virheet['tunnus'] = "Tunnus on jo käytössä, käytä jotain toista tunnusta!";
    $this->tunnus = $tunnus;
}
public function setSalasana($salasana) {
    if (strlen($salasana)<8) $this->virheet['salasana'] = "Salasanassa täytyy olla vähintään 8 merkkiä!";
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
  
  /* etsii käyttäjän käyttäjän tietokantaindeksillä */
  public static function etsiKayttajaIndeksilla($kayttaja_id) {
    $sql = "SELECT kayttaja_id, tunnus, salasana, muokkausoikeus, adminoikeus FROM kayttajat WHERE kayttaja_id = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja_id));

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
  
  /* varmistaa, ettei samaa käyttäjätunnusta ole jo tietokannasta */
  public static function onkoTunnusta($tunnus) {
    $sql = "SELECT tunnus FROM kayttajat WHERE tunnus = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($tunnus));

    $tulos = $kysely->fetchObject();
    if ($tulos == null) return false;
    else return true;
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

  /* käyttäjän rekisteröitymistä varten */
  public function lisaaKantaan() {
    $sql = "SELECT max(kayttaja_id)+1 FROM kayttajat";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    $luku = $kysely->fetchColumn();
    $sql = "INSERT INTO kayttajat (kayttaja_id, tunnus, salasana, muokkausoikeus, adminoikeus) VALUES (?,?,?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($luku, $this->getTunnus(), $this->getSalasana(), $this->getMuokkausoikeus(), $this->getAdminoikeus())); 
    return $ok;
  }
   
    /* päivittää tietokantaan moderointi- ja reseptimuokkausoikeuksen muutokset */
    public function muokkaaOikeuksia($kayttaja_id) {
        $sql = "UPDATE kayttajat SET muokkausoikeus = ?, adminoikeus = ? WHERE kayttaja_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getMuokkausoikeus(), $this->getAdminoikeus(), $kayttaja_id));
    }
    
    /* metodi vaihtaa salasanan, joka moderaattorin tai käyttäjän kutsumana */
    public function vaihdaSalasanaa($kayttaja_id) {
        $sql = "UPDATE kayttajat SET salasana = ? WHERE kayttaja_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getSalasana(), $kayttaja_id));
    }
   
   /* metodi poistaa käyttäjätiedot, joka moderaattorin tai käyttäjän kutsumana */
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