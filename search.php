<?php
  // etsii yksittäisen drinkin tiedot ja lataa tietolomakkeen  

  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
 
  $drinkki = Drinkki::etsi(sanitoi($_GET['drinkki_id']));
  $ainesosat = Raakaaine::etsiAinesosat(sanitoi($_GET['drinkki_id']));

  if ($drinkki != null) {
  naytaNakyma("drinkkitieto.php", array(
    'drinkki' => $drinkki,
    'ainesosat' => $ainesosat
  ));
} else {
  naytaNakyma("drinkkitieto.php", array(
    'drinkki' => null,
    'virhe' => "Drinkkiä ei löytynyt!"
  ));
}
   