<?php
// kontrolleri, joka lataa drinkkilomakkeen reseptien lisäämistä varten

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';
  
$luku = 5; /* ainesosien lukumäärä aluksi uudessa drinkkireseptissä */
        
 if (oikeusMuokata()==true)  {
    naytaNakyma('drinkkilomake.php', array(
    'luku' => $luku  
  ));}
 else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi lisätä reseptejä ennen kuin kirjaudut tunnuksillasi!",
      ));}