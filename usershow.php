<?php

  require_once 'libs/common.php';
  require_once 'libs/models/kayttaja.php';
  
  $kayttajat = Kayttaja::etsiKaikkiKayttajat();
  naytaNakyma('kayttajalista.php', array(
    'kayttajat' => $kayttajat
  ));