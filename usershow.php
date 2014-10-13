<?php
  /* Kontrolleri, joka näyttää listauksen kaikista käyttäjistä
   * jos katsojalla on moderointioikeudet, jotka tarkistetaan common.php:stä
   */
  require_once 'libs/common.php';
  require_once 'libs/models/kayttaja.php';
  
   $sivu = 1;
  if (isset($_GET['sivu'])) {
    $sivu = sanitoi((int)$_GET['sivu']);

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) $sivu = 1;
  }
  $montakosivulla=10;
  $lkm = Kayttaja::lukumaara();
  $sivuja = ceil($lkm/$montakosivulla);
  
  if (oikeusModeroida()) {
  $kayttajat = Kayttaja::getKayttajatSivulla ($sivu, $montakosivulla);
  naytaNakyma('kayttajalista.php', array(
    'kayttajat' => $kayttajat,
    'sivu' => $sivu,
    'sivuja' => $sivuja,
    'montakosivulla' => $montakosivulla,
    'lkm' => $lkm
  ));}
  
  else naytaNakyma('kirjautuminen.php', array(  
      'virhe' => "Sinulla ei ole oikeutta tälle sivulle!",
)); 
  