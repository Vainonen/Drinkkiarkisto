<?php
// kontrolleri, joka poistaa drinkkireseptin tietokannasta 

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';

 if (oikeusMuokata()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
Drinkki::poistaDrinkki(sanitoi($_GET['drinkki_id']));
 naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Drinkki poistettu arkistosta!"
  ));
    }
 
else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi poistaa reseptejä ennen kuin kirjaudut tunnuksillasi!",
));}


