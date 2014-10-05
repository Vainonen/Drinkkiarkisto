<?php
// kontrolleri, joka lataa drinkkilomakkeen reseptien lisäämistä varten

require_once 'libs/common.php';
require_once 'libs/models/raakaaine.php';
  
 if (oikeusMuokata()==true)  {
    naytaNakyma('drinkkilomake.php');}
 else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi lisätä reseptejä ennen kuin kirjaudut tunnuksillasi!",
      ));}