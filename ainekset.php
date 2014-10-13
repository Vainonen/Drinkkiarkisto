<?php
  /* Kontrolleri, joka näyttää listauksen drinkkiaineksista */
  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
  
  $raakaaineet = Raakaaine::etsiKaikkiRaakaaineet();
      

  naytaNakyma('aineslista.php', array(
    'raakaaineet' => $raakaaineet
  ));