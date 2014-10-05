<?php
/*lataa drinkkireseptin muokkauslomakkeen ja tarkistaa, että onko
 * käyttäjällä muokkausoikeus
 */

require_once 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/raakaaine.php';

 if (oikeusMuokata()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
 $drinkki = Drinkki::etsi(sanitoi($_GET['drinkki_id']));
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
else if (kirjautunutko() && !oikeusMuokata()) 
    naytaNakyma('kirjautuminen.php', array(  
      'virhe' => "Et voi muokata reseptejä ennen kuin olet hankkinut oikeudet moderaattorilta!",
));
    
else {naytaNakyma('kirjautuminen.php', array( 
      'virhe' => "Et voi muokata reseptejä ennen kuin kirjaudut tunnuksillasi!",
));}