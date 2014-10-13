<?php
// kontrolleri, joka poistaa käyttäjän tietokannasta 

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

 if (oikeusMuokata()) {
    //Koodia, jonka vain kirjautunut käyttäjä saa suorittaa
Kayttaja::poistaKayttaja(sanitoi($_GET['kayttaja_id']));
 header('Location: usershow.php');
  //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.
  $_SESSION['ilmoitus'] = "Käyttäjä poistettu onnistuneesti.";
    }
 
else {naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Sinulla ei ole lupaa tälle sivulle!",
));}