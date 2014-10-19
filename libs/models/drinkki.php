<?php
require_once 'libs/tietokantayhteys.php';
class Drinkki {
  
  private $drinkki_id;
  private $nimi;
  private $aliakset;
  private $drinkkityyppi;
  private $valmistustapa;
  private $ehdotus; // integer-arvo 0 tai 1 totuusarvona, drinkkilistauksessa drinkki näytetään, jos ehdotus=0, ehdotuslistauksessa taas, jos ehdotus=1
  private $virheet;
  
  public function __construct($drinkki_id, $nimi, $aliakset, $drinkkityyppi, $valmistustapa, $ehdotus, $virheet) {
    $this->drinkki_id = $drinkki_id;
    $this->nimi = $nimi;
    $this->aliakset = $aliakset;
    $this->drinkkityyppi = $drinkkityyppi;
    $this->valmistustapa = $valmistustapa;
    $this->ehdotus = $ehdotus;
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
public function getEhdotus() {
    return $this->ehdotus;
}
public function getVirheet() {
    return $this->virheet;
}

public function setDrinkkiId($drinkki_id) {
    $this->drinkki_id = $drinkki_id;
}
public function setNimi($nimi) {
    $this->nimi = $nimi;
    if (strlen($nimi)<1 || strlen($nimi)>100) {
        $this->virheet['nimi'] = "Nimessä on oltava 1-100 merkkiä";
    }
    else {
        unset($this->virheet['nimi']);
    }
}
public function setAliakset($aliakset) {
    $this->aliakset = $aliakset;
    if (strlen($aliakset)>100) {
        $this->virheet['aliakset'] = "Vaihtoehtoisissa nimityksissä saa olla vain 100 merkkiä";
    } else {
        unset($this->virheet['aliakset']);
    }
    }
public function setDrinkkityyppi($drinkkityyppi) {
    $this->drinkkityyppi = $drinkkityyppi;
    }
public function setValmistustapa($valmistustapa) {
    $this->valmistustapa = $valmistustapa;
    if (strlen($valmistustapa)>100) {
        $this->virheet['valmistustapa'] = "Valmistustapaan voi laittaa vain 100 merkkiä";
    } else {
        unset($this->virheet['valmistustapa']);
    }
    }
public function setEhdotus($ehdotus) {
    $this->ehdotus = $ehdotus;
}

 /* etsii drinkin tai reseptiehdotuksen tiedot postgresql-tietokannasta id-tunnuksen mukaan */
 public static function etsi($drinkki_id) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, 
          valmistustapa, ehdotus FROM drinkit WHERE drinkki_id = ?";
    return Drinkki::teeKysely($sql, $drinkki_id);     
 }
  
  /* etsii hakusanamerkkijonoa nimi- ja aliaskentistä */
  public static function etsiNimi($nimi, $sivu, $montako) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, valmistustapa, ehdotus "
            . "FROM drinkit WHERE nimi ILIKE ? OR aliakset ILIKE ? AND ehdotus = '0' ORDER by nimi LIMIT ? OFFSET ?";
    $mjono = ('%'.$nimi.'%');
    $drinkit = Drinkki::teeListakysely($sql, array($mjono, $mjono, $montako, ($sivu-1)*$montako)); 
    return $drinkit; 
  }
  
  /* etsii kaikki reseptiehdotukset tietokannasta */
  public static function etsiKaikkiEhdotukset($sivu, $montako) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, 
          valmistustapa, ehdotus FROM drinkit WHERE ehdotus = '1' ORDER by nimi LIMIT ? OFFSET ?";
    return Drinkki::teeListakysely($sql, array($montako, ($sivu-1)*$montako)); 
}

  /* etsii drinkit ainesosien mukaan Aines-osat välitaulun kautta */
  public static function etsiDrinkitAineksella($raakaaine_id) {
    $sql = "SELECT drinkit.drinkki_id, drinkit.nimi, aliakset, drinkkityyppi, valmistustapa, ehdotus " 
            . "FROM drinkit JOIN ainesosat ON drinkit.drinkki_id=ainesosat.drinkki_id "
            . "JOIN raakaaineet ON raakaaineet.raakaaine_id=ainesosat.raakaaine_id "
            . "WHERE ainesosat.raakaaine_id=? AND ehdotus = '0' ORDER by nimi"; 
    return Drinkki::teeListakysely($sql, array($raakaaine_id)); 
  }
  
  /* etsii drinkit tyyppien mukaan Aines-osat välitaulun kautta */
  public static function etsiDrinkitTyypilla($drinkkityyppi, $sivu, $montako) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, valmistustapa, ehdotus FROM drinkit "
            . "WHERE drinkkityyppi = ? AND ehdotus = '0' ORDER by nimi LIMIT ? OFFSET ?";
    return Drinkki::teeListakysely($sql, array($drinkkityyppi, $montako, ($sivu-1)*$montako)); 
  }
  
  /* getteri näkymää varten, parametreinä sivunumero ja sivulla esitettävien
   * drinkkien lukumäärä
   */
  public static function getDrinkitSivulla ($sivu, $montako) {
    $sql = "SELECT drinkki_id, nimi, aliakset, drinkkityyppi, valmistustapa, ehdotus"
            . " FROM drinkit WHERE ehdotus = '0' ORDER by nimi LIMIT ? OFFSET ?";
    return Drinkki::teeListakysely($sql, array($montako, ($sivu-1)*$montako)); 
  }
  
  /* getteri ainesten esiintymien määrälle eri drinkeissä */
  public static function aineslukumaara($raakaaine_id) {
    $sql = "SELECT count(*) FROM ainesosat JOIN raakaaineet ON raakaaineet.raakaaine_id=ainesosat.raakaaine_id WHERE raakaaine_id=? AND ehdotus = '0'";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($raakaaine_id));
    return $kysely->fetchColumn();
    }
    
  /* getteri tietyn drinkkityypin esiintymien määrälle */
  public static function tyyppilukumaara($drinkkityyppi) {
    $sql = "SELECT count(*) FROM drinkit WHERE drinkkityyppi = ? AND ehdotus = '0'";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($drinkkityyppi));
    return $kysely->fetchColumn();
    }  
  
  /* getteri tietyn hakusanan esiintymien määrälle */
  public static function nimimaara($nimi) {
    $sql = "SELECT count(*) FROM drinkit WHERE nimi ILIKE ? AND ehdotus = '0'";
    $mjono = ('%'.$nimi.'%');
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($mjono));
    $maara = $kysely->fetchColumn();
    $sql = "SELECT count(*) FROM drinkit WHERE aliakset ILIKE ? AND ehdotus = '0'";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($mjono));
    $maara += $kysely->fetchColumn();
    return $maara;
  }
  
  /* getteri drinkkien lukumäärälle */
  public static function lukumaara() {
    $sql = "SELECT count(*) FROM drinkit WHERE ehdotus = '0'";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }

  /* getteri reseptiehdotusten lukumäärälle */
  public static function ehdotuslukumaara() {
    $sql = "SELECT count(*) FROM drinkit WHERE ehdotus = '1'";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely->fetchColumn();
    }
    
  /* lisää reseptin postgresql-tietokantaan, joka huolehtii drinkki_id-muuttujan 
     lisäämisestä */
  public function lisaaKantaan() {
    $sql = "SELECT max(drinkki_id)+1 FROM drinkit"; //selvitetään tietokannasta maksimiarvo sitä yhtä suuremmalle id-numerolle 
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    $luku = $kysely->fetchColumn();
    $sql = "INSERT INTO drinkit (drinkki_id, nimi, aliakset, drinkkityyppi, valmistustapa, ehdotus) VALUES (?,?,?,?,?,?)";
    $kysely = getTietokantayhteys()->prepare($sql); 
    $ok = $kysely->execute(array($luku, $this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa(), $this->getEhdotus())); 
 
    return $luku;
  }
   
    /* päivittää tietokantaan muutokset drinkki_id-indeksinumeron perusteella */
    public function muokkaaKantaa($drinkki_id) {
        $sql = "UPDATE drinkit SET nimi = ?, aliakset = ?, drinkkityyppi = ?, valmistustapa = ?, ehdotus = ? WHERE drinkki_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getAliakset(), $this->getDrinkkityyppi(), $this->getValmistustapa(), $this->getEhdotus(), $drinkki_id));
        return $ok;
    }
   
   /* poistaa reseptin tietokannasta drinkki_id-indeksinumeron perusteella */
   public function poistaDrinkki($drinkki_id) {
    $sql = "DELETE FROM drinkit WHERE drinkki_id = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($drinkki_id));
    }
  
    /* Palauttaa true, jos drinkkiin syötetyt arvot ovat järkeviä. */
    public function onkoKelvollinen() {
    return empty($this->virheet);
    }

  
    /* tekee tietokantakyselyn parametrinä SQL-lauseke ja haettava muuttuja palauttaen drinkkiolion, jos sellainen on */
    function teeKysely($sql, $muuttuja) {
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($muuttuja));
        $tulos = $kysely->fetchObject();
        $tulokset = array();
        if ($tulos == null) {
            return null;
        }
        else {
            $drinkki = new Drinkki($tulos->drinkki_id, $tulos->nimi, $tulos->aliakset,
            $tulos->drinkkityyppi, $tulos->valmistustapa, $tulos->ehdotus);   
            $tulokset[] = $drinkki;
            return $tulokset;
    }
    }
    
    /* tekee tietokantakyselyn parametrinä SQL-lauseke ja haettava muuttuja palauttaen taulukon useammasta drinkkiolioista */
    function teeListakysely($sql, $muuttuja) {
        $kysely = getTietokantayhteys()->prepare($sql); 
        if (is_array($muuttuja)) $kysely->execute($muuttuja);
        else $kysely->execute(array($muuttuja));
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $drinkki = new Drinkki($tulos->drinkki_id, $tulos->nimi, $tulos->aliakset,
            $tulos->drinkkityyppi, $tulos->valmistustapa, $tulos->ehdotus);  
            $tulokset[] = $drinkki;
        }
    return $tulokset;
    }
}