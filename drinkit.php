<?php

  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  
  $sivu = 1;
  if (isset($_GET['sivu'])) {
    $sivu = (int)$_GET['sivu'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) $sivu = 1;
  }
  $montakosivulla=10;
  $lkm = Drinkki::lukumaara();
  $sivuja = ceil($lkm/$montakosivulla);
  
  $drinkit = Drinkki::getDrinkitSivulla ($sivu, $montakosivulla);
  naytaNakyma('drinkkilista.php', array(
    'drinkit' => $drinkit,
    'sivu' => $sivu,
    'sivuja' => $sivuja,
    'montakosivulla' => $montakosivulla,
    'lkm' => $lkm
  ));