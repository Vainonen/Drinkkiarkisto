<?php
  require 'tietokantayhteys.php';
  require 'kayttaja.php';


echo etsiKaikkiKayttajat();

  function etsiKaikkiKayttajat() {

  $sql = "SELECT id, tunnus, salasana, muokkausoikeus, adminoikeus from kayttajat";
  $kysely = getTietokantayhteys()->prepare($sql); 
  $kysely->execute();
    
  $tulokset = array();
  foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $kayttaja = new Kayttaja();
    $kayttaja->setId($tulos->id);
    $kayttaja->setTunnus($tulos->tunnus);
    $kayttaja->setSalanana($tulos->salasana);
    $kayttaja->setMuokkausoikeus($tulos->muokkausoikeus);
    $kayttaja->setAdminoikeus($tulos->adminoikeus);

    //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
    //Se vastaa melko suoraan ArrayList:in add-metodia.
    $tulokset[] = $kayttaja;
  }
  return $tulokset;
}