<?php
  /* Kontrolleri, joka näyttää listauksen kaikista drinkkiresepteistä 
   * ainesosan mukaan
   */
  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
  
  $id = sanitoi((int)$_GET['raakaaine_id']);
  $drinkit = Drinkki::etsiDrinkitAineksella($id);
 
  naytaNakyma('drinkkilista_aineet.php', array(
    'drinkit' => $drinkit
  ));
    
    