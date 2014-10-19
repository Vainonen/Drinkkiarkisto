<?php

/* Kontrolleri käyttäjätietojen muokkausta varten */
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if (!oikeusModeroida()) {
naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Sinulla ei ollut lupaa edelliselle sivulle!",
));}

$id = sanitoi((int)$_GET['kayttaja_id']);
$muokkausoikeus = sanitoi($_POST['muokkausoikeus']);
$adminoikeus = sanitoi($_POST['adminoikeus']);

if (sanitoi($_POST['tallenna'])=="tallenna") {
    
$uusi = new Kayttaja();
if ($muokkausoikeus==1) $uusi->setMuokkausoikeus(1);
else $uusi->setMuokkausoikeus(0);
if ($adminoikeus==1) $uusi->setAdminoikeus(1);
else $uusi->setAdminoikeus(0);
$uusi->setSalasana(sanitoi($_POST['salasana']));

if ($uusi->onkoKelvollinen()) {
  $uusi->muokkaaOikeuksia($id);
  $uusi->vaihdaSalasanaa($id);
  header('Location: kayttajat.php');
  $_SESSION['ilmoitus'] = "Käyttäjäoikeuksia muokattu onnistuneesti.";

} else {
  $virheet = $uusi->getVirheet();
  foreach($taulukko->virheet as $virhe)
 {echo $taulukko->virhe;}
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
    header('Location: kayttajat.php');
    //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.
    $_SESSION['ilmoitus'] = "Käyttäjä poistettu onnistuneesti.";
    } 
}