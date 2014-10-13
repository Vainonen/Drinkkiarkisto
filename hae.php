<?php
  // etsii yksittäisen drinkin tiedot ja lataa tietolomakkeen  

  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
 
  $drinkki = Drinkki::etsiNimi(sanitoi($_POST['drinkki']));
  foreach ($drinkki as $juoma) {
    $id = $juoma->getDrinkkiId();
    }
     $ainesosat = Raakaaine::etsiAinesosat($id);

  if ($drinkki != null) {
  naytaNakyma("drinkkitieto.php", array(
    'drinkki' => $drinkki,
    'ainesosat' => $ainesosat 
  ));
} else {$_SESSION['ilmoitus'] = "Drinkkiä ei löytynyt, hae jollain muulla nimellä!";
  naytaNakyma("etusivu.php", array(
    'drinkki' => null
  ));
}
   