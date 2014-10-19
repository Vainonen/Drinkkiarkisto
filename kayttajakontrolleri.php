<?php
/* lataa käyttäjäoikeuksien muokkauslomakkeen ja tarkistaa, että onko
 * tämän sivun lataajalla moderointioikeus
 */

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

$id = sanitoi((int)$_POST['id']);
        
if ($_SESSION['id'] == $id) 
    // omia oikeuksia ei voi poistaa, ohjataan moderaattori takaisin käyttäjälistaukseen
    {header('Location: kayttajat.php'); 
    }
    
 if (oikeusModeroida()) {
  $kayttaja = Kayttaja::etsiKayttajaIndeksilla($id); 
  
    if ($kayttaja != null) {  
    naytaNakyma("kayttajatieto.php", array(
    'kayttaja' => $kayttaja));     
    }
  else {
  naytaNakyma("kayttajatieto.php", array(
    'kayttaja' => null,
    'virhe' => "Käyttäjää ei löytynyt!"
    ));
    }
 }
    
else {naytaNakyma('kirjautuminen.php', array( 
      'virhe' => "Sinulla ei ole oikeutta tälle sivulle!",));
}