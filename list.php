<?php
  /* Kontrolleri, joka näyttää listauksen kaikista drinkkiresepteistä 
   * ainesosan mukaan
   */
  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
  
  $drinkit = Drinkki::etsiDrinkitAineksella(sanitoi((int)$_GET['raakaaine_id']));
   
  $lkm = 10;
   echo $lkm;
  
    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) $sivu = 1;
 
  $montakosivulla=10;
  $sivuja = ceil($lkm/$montakosivulla);
  
  naytaNakyma('drinkkilista.php', array(
    'drinkit' => $drinkit,
    'sivu' => $sivu,
    'sivuja' => $sivuja,
    'montakosivulla' => $montakosivulla,
    'lkm' => $lkm
  ));
    
    