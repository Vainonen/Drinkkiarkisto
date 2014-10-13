<?php
/* kontrolleri, joka tarkistaa, että käyttäjän antama reseptilisäys  
   tai -muokkaus kunnollinen */

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';

$uusi = new Drinkki();
$uusi->setNimi(sanitoi($_POST['nimi']));
$uusi->setAliakset(sanitoi($_POST['aliakset']));
$uusi->setDrinkkityyppi(sanitoi($_POST['drinkkityyppi']));
$uusi->setValmistustapa(sanitoi($_POST['valmistustapa']));

$tulokset = array();
$ainevirheet = 0;

for ($i=0; $i<5; $i++) {
    echo $_POST['tilavuus'][$i];
    echo $_POST['raakaaine'][$i];
    if (!empty($_POST['tilavuus'][$i]) && !empty($_POST['raakaaine'][$i])) {
    $ainesosa = new Raakaaine(); 
    $ainesosa->setTilavuus(sanitoi($_POST['tilavuus'][$i]));  
    $ainesosa->setAineId(sanitoi($_POST['raakaaine'][$i]));
    if (!($ainesosa->onkoKelvollinen())) $ainevirheet++;
    $tulokset[]=$ainesosa;

    }
}

echo ('toimii');

if ($uusi->onkoKelvollinen() && $ainevirheet == 0) {
    if (sanitoi($_POST['tallenna'])=="uusi") {
        $numero=$uusi->lisaaKantaan();
        foreach ($tulokset as $tulos) $tulos->lisaaAineJuomaan($numero, $tulos->getAineId());
        $_SESSION['ilmoitus'] = "Drinkki lisätty onnistuneesti.";}
    if (sanitoi($_POST['tallenna'])=="vanha") {
        $numero=sanitoi($_GET['drinkki_id']);
        $uusi->muokkaaKantaa($numero);
        Raakaaine::poistaAinesosat ($numero);
        foreach ($tulokset as $tulos) $tulos->lisaaAineJuomaan($numero, $tulos->getAineId());
        $_SESSION['ilmoitus'] = "Drinkkiä muokattu onnistuneesti.";
    }       
          
  //Drinkki lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
  header('Location: drinkit.php');
  //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.

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
 
 