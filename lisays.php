<?php
session_start();
require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';

$uusi = new Drinkki();
$uusi->setNimi($_POST['nimi']);
$uusi->setAliakset($_POST['aliakset']);
$uusi->setDrinkkityyppi($_POST['drinkkityyppi']);
$uusi->setValmistustapa($_POST['valmistustapa']);

if ($uusi->onkoKelvollinen()) {
  $uusi->lisaaKantaan();
  
  //Kissa lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
  header('Location: drinkit.php');
  //Asetetaan istuntoon ilmoitus siitä, että kissa on lisätty.
  //Tästä tekniikasta kerrotaan lisää kohta
  $_SESSION['ilmoitus'] = "Drinkki lisätty onnistuneesti.";

} else {
  $virheet = $uusi->getVirheet();
 foreach($taulukko->virheet as $virhe)
 {echo $taulukko->virhe;}
  //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
  naytaNakyma ("drinkkilomake.php", array(
    'drinkki' => $uusi,
    'virheet' => $virheet
  ));
}