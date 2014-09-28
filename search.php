<?php

  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  
  
  
 

  $drinkki = Drinkki::etsi($_GET['id']);
  if ($drinkki != null) {
  naytaNakyma("drinkkitieto.php", array(
    'drinkki' => $drinkki
  ));
} else {
  naytaNakyma("drinkkitieto.php", array(
    'drinkki' => null,
    'virhe' => "Drinkkiä ei löytynyt!"
  ));
}
