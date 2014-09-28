<?php
session_start();
require_once 'libs/common.php';
 if (kirjautunutko()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
 naytaNakyma('drinkkilomake.php');}
else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi lisätä reseptejä ennen kuin kirjaudut tunnuksillasi!",
));}