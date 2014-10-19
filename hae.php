<?php
  /* etsii yksittäisen drinkin tiedot hakusanan tai indeksin perusteella 
   * ja lataa tietolomakkeen  
   */

  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
 
$id = (sanitoi($_GET['drinkki_id']));
$nimi = sanitoi($_POST['drinkki']);

  if (!empty($id)) { 
      $drinkki = Drinkki::etsi($id);
      }

  if (!empty($nimi)) {
      $drinkki = Drinkki::etsiNimi($nimi);
      foreach ($drinkki as $juoma) $id = $juoma->getDrinkkiId();
      }
    
  if ($drinkki != null) {
      $ainesosat = Raakaaine::etsiAinesosat($id);
      naytaNakyma("drinkkitieto.php", array(
      'drinkki' => $drinkki,
      'ainesosat' => $ainesosat 
      ));} 
  else {$_SESSION['ilmoitus'] = "Drinkkiä ei löytynyt, hae jollain muulla nimellä!";
      naytaNakyma("etusivu.php", array(
      'drinkki' => null
    ));
    }
  
     