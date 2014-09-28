<?php
session_start();
require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';

 if (kirjautunutko()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
Drinkki::poistaDrinkki($_GET['id']);
 naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Drinkki poistettu arkistosta!"
  ));
    }
 
else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi poistaa reseptejä ennen kuin kirjaudut tunnuksillasi!",
));}


