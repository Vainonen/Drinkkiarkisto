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
  $uusi->muokkaaKantaa($_GET['id']);  
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
