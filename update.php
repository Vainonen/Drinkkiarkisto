<?php
session_start();
require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';

 if (kirjautunutko()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
 $drinkki = Drinkki::etsi($_GET['id']);
  if ($drinkki != null) {
  naytaNakyma("drinkkimuokkaus.php", array(
    'drinkki' => $drinkki
  ));}
  else {
  naytaNakyma("drinkkimuokkaus.php", array(
    'drinkki' => null,
    'virhe' => "Drinkkiä ei löytynyt!"
  ));
    }
 }
else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Et voi muokata reseptejä ennen kuin kirjaudut tunnuksillasi!",
));}