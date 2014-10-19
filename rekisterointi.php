<?php
/* tarkistaa rekisteröitymislomakkeesta palautettujen tietojen oikeellisuuden*/

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';
  //Tarkistetaan että vaaditut kentät on täytetty:
  if (empty($_POST["username"])) {
    naytaNakyma('rekisteroityminen.php', array(
      'virhe' => "Rekisteröityminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
  }
  
  if (empty($_POST["password1"])) {
    naytaNakyma('rekisteroityminen.php', array(
      'virhe' => "Rekisteröityminen epäonnistui! Et antanut salasanaa.",
    ));
  }
  
  if (empty($_POST["password2"])) {
    naytaNakyma('rekisteroityminen.php', array(
      'virhe' => "Rekisteröityminen epäonnistui! Anna salasana toisen kerran.",
    ));
  }
  
  $salasana1 = sanitoi($_POST["password1"]);
  $salasana2 = sanitoi($_POST["password2"]);
  
  if ($salasana1 != $salasana2) {
    naytaNakyma('rekisteroityminen.php', array(
      'virhe' => "Rekisteröityminen epäonnistui! Salasanat eivät täsmänneet.",
    ));
  }
    
 
$uusi = new Kayttaja();
$uusi->setTunnus(sanitoi($_POST['username']));
$uusi->setSalasana(sanitoi($_POST['password1']));
$uusi->setMuokkausoikeus(0);
$uusi->setAdminoikeus(0);
  
  if ($uusi->onkoKelvollinen()) {
  $uusi->lisaaKantaan();
  
  //Käyttäjä rekisteröitiin  onnistuneesti, lähetetään käyttäjä eteenpäin
  header('Location: drinkit.php');
  //Asetetaan istuntoon ilmoitus siitä, että käyttäjä on rekisteröity.
  $_SESSION['ilmoitus'] = "Rekisteröitymisesi onnistui. Jos haluat oikeuksia muokata drinkkireseptejä, ota yhteyttä moderaattoriin xxxxxx@xxx.xxx";

} else {
  $virheet = $uusi->getVirheet();
  naytaNakyma ("rekisteroityminen.php", array(
    'virheet' => $virheet
  ));
}