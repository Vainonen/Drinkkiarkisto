<?php
/* kontrolleri, joka tarkistaa, että käyttäjän antama reseptilisäys,  
   -muokkaus tai -ehdotus kunnollinen */

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';

$uusi = new Drinkki();
$uusi->setNimi(sanitoi($_POST['nimi']));
$uusi->setAliakset(sanitoi($_POST['aliakset']));
$uusi->setDrinkkityyppi(sanitoi($_POST['drinkkityyppi']));
$uusi->setValmistustapa(sanitoi($_POST['valmistustapa']));
if (sanitoi($_POST['tallenna'])=="ehdotus") $uusi->setEhdotus(1); // ehdotukselle annetaan totuusarvoksi 1
else $uusi->setEhdotus(0); // lisäykselle tai muokkaukselle annetaan totuusarvoksi 0
$ehdotus = $uusi->getEhdotus();

$tulokset = array();
$ainevirheet = array();
$ainesmaara = 0;

for ($i=0; $i<5; $i++) {
    if (!empty($_POST['tilavuus'][$i]) || !empty($_POST['raakaaine'][$i])) {
    $ainesosa = new Raakaaine(); 
    $ainesosa->setTilavuus(sanitoi($_POST['tilavuus'][$i]));  
    $ainesosa->setAineId(sanitoi($_POST['raakaaine'][$i]));
    //if (!($ainesosa->onkoKelvollinen())) $ainevirheet;
    $tulokset[]=$ainesosa;
    $ainesmaara++;
    $ainevirhe = $ainesosa->getVirheet();
    $ainevirheet = $ainevirhe;
    }
}

if ($uusi->onkoKelvollinen() && empty($ainevirheet) && $ainesmaara>0) {
    if (sanitoi($_POST['tallenna'])=="ehdotus") {
        $numero=$uusi->lisaaKantaan();
        foreach ($tulokset as $tulos) $tulos->lisaaAineJuomaan($numero, $tulos->getAineId());
        $_SESSION['ilmoitus'] = "Ehdotus lähetetty onnistuneesti.";}
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
} else {
  $virheet = $uusi->getVirheet();
  $ehdotus = $uusi->getEhdotus();
  if ($ainesmaara==0) $ainevirheet[maara]="Ainesosia pitää olla vähintään yksi!";
  //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
  if (sanitoi($_POST['tallenna'])=="uusi") {
  naytaNakyma ("drinkkilomake.php", array(
    'drinkki' => $uusi,
    'virheet' => $virheet,
    'ainevirheet' => $ainevirheet,
    'ehdotus' => $ehdotus
  ));
  }
  if (sanitoi($_POST['tallenna'])=="vanha") {
      $id=sanitoi($_GET['drinkki_id']);
      $uusi->setDrinkkiId($id);
  naytaNakyma ("drinkkimuokkaus.php", array(
    'drinkki' => $uusi,
    'virheet' => $virheet,
    'ainevirheet' => $ainevirheet,
    'ehdotus' => $ehdotus
  ));
  }
}
 
