<?php
/* kontrolleri, joka tarkistaa, että käyttäjän antama reseptilisäys on 
   kunnollinen */

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';

$uusi=($_POST['tilavuus']);
echo($uusi[0]);
$aine=($_POST['raakaaine']);
echo($aine[0]);

/*
$uusi = new Drinkki();
$uusi->setNimi(sanitoi($_POST['nimi']));
$uusi->setAliakset(sanitoi($_POST['aliakset']));
$uusi->setDrinkkityyppi(sanitoi($_POST['drinkkityyppi']));
$uusi->setValmistustapa(sanitoi($_POST['valmistustapa']));




if ($uusi->onkoKelvollinen()) {
  $uusi->lisaaKantaan();
  
  //Drinkki lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
  header('Location: drinkit.php');
  //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.
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
 */
 