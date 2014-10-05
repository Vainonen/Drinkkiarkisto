<?php
/* Kontrolleri drinkkireseptin muokkauta varten, drinkki-luokan ja 
 * common.php-tiedoston metodit huolehtivat syötteiden oikeellisuudesta
 * ja tietoturvasta 
 */


require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';

$uusi = new Drinkki();
$uusi->setNimi(sanitoi($_POST['nimi']));
$uusi->setAliakset(sanitoi($_POST['aliakset']));
$uusi->setDrinkkityyppi(sanitoi($_POST['drinkkityyppi']));
$uusi->setValmistustapa(sanitoi($_POST['valmistustapa']));

if ($uusi->onkoKelvollinen()) {
  $uusi->muokkaaKantaa(sanitoi($_GET['drinkki_id']));  
  header('Location: drinkit.php');
  $_SESSION['ilmoitus'] = "Drinkkiä muokattu onnistuneesti.";

} else {
  $virheet = $uusi->getVirheet();
 foreach($taulukko->virheet as $virhe)
 {echo $taulukko->virhe;}
  //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
  naytaNakyma ("drinkkimuokkaus.php", array(
    'drinkki' => $uusi,
    'virheet' => $virheet
  ));
    }
