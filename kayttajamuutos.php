<?php

/* Kontrolleri käyttäjätietojen muokkausta varten */
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if (!oikeusModeroida()) {
naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Sinulla ei ole lupaa tälle sivulle!",
));}

if ($_SESSION['id'] == (sanitoi($_GET['kayttaja_id']))) 
    {naytaNakyma('usershow.php', array(
      'virhe' => "Et voi poistaa tai muokata omia oikeuksiasi!",
    ));}
    
if (sanitoi($_POST['tallenna'])=="tallenna") {
    
$uusi = new Kayttaja();
$uusi->setMuokkausoikeus(sanitoi($_POST['aliakset']));
$uusi->setAdminoikeus(sanitoi($_POST['drinkkityyppi']));

if ($uusi->onkoKelvollinen()) {
  $uusi->muokkaaOikeuksia(sanitoi($_GET['drinkki_id']));  
  header('Location: usershow.php');
  $_SESSION['ilmoitus'] = "Käyttäjäoikeuksia muokattu onnistuneesti.";

} else {
  $virheet = $uusi->getVirheet();
 foreach($taulukko->virheet as $virhe)
 {echo $taulukko->virhe;}
  //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
  naytaNakyma ("kayttajatieto.php", array(
    'kayttaja' => $uusi,
    'virheet' => $virheet
  ));
    }
}

if (sanitoi($_POST['tallenna'])=="poista") {
    if (oikeusModeroida()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
    Kayttaja::poistaKayttaja(sanitoi($_GET['kayttaja_id']));
    header('Location: usershow.php');
    //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.
    $_SESSION['ilmoitus'] = "Käyttäjä poistettu onnistuneesti.";
    } 
}