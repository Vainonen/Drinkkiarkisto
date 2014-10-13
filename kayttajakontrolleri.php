<?php
/* lataa käyttäjäoikeuksien muokkauslomakkeen ja tarkistaa, että onko
 * käyttäjällä muokkausoikeus
 */

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

 if (oikeusModeroida()) {
  $kayttaja = Kayttaja::etsiKayttajaIndeksilla(sanitoi((int)$_POST['id'])); 
  if ($kayttaja != null) {
  naytaNakyma("kayttajatieto.php", array(
    'kayttaja' => $kayttaja,
  ));}
  else {
  naytaNakyma("kayttajatieto.php", array(
    'kayttaja' => null,
    'virhe' => "Käyttäjää ei löytynyt!"
  ));
    }
 }
    
else {naytaNakyma('kirjautuminen.php', array( 
      'virhe' => "Sinulla ei ole oikeutta tälle sivulle!",
));}
