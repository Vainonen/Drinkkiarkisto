<?php
  /* Kontrolleri, joka näyttää kolme erityyppistä listausta resepteistä: 
   * kaikki, drinkkityypin mukaan tai hakusanan mukaan
   */
  require_once 'libs/common.php';
  require_once 'libs/models/drinkki.php';
  require_once 'libs/models/raakaaine.php';
  
  $drinkkityyppi = (sanitoi($_GET['drinkkityyppi']));
  $nimi = (sanitoi($_GET['nimi'])); //jos hakunimi on lähetetty drinkkilistaussivulta
  $nimi = (sanitoi($_POST['nimi'])); //jos hakunimi on lähetetty hakukentästä
  $ehdotus = (sanitoi($_GET['ehdotus'])); //jos kyseessä on reseptiehdotushaku (arvo = 1)
  
  //sivutus, vaihtoehtoisesti kaikki drinkit tai drinkkityypit
  $sivu = 1;
  if (isset($_GET['sivu'])) {
    $sivu = sanitoi((int)$_GET['sivu']);

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1) $sivu = 1;
  }
  $montakosivulla=10;
  if ($ehdotus==1 && oikeusMuokata()) {
      $lkm = Drinkki::ehdotuslukumaara();
      $sivuja = ceil($lkm/$montakosivulla);
      $drinkit = Drinkki::etsiKaikkiEhdotukset ($sivu, $montakosivulla);
  }    
  if (empty($ehdotus) && empty($drinkkityyppi) && empty($nimi)) {
      $lkm = Drinkki::lukumaara();
      $sivuja = ceil($lkm/$montakosivulla);
      $drinkit = Drinkki::getDrinkitSivulla ($sivu, $montakosivulla);
  }
  if (!empty($drinkkityyppi) && empty ($ehdotus)) {
      $lkm = Drinkki::tyyppilukumaara($drinkkityyppi);
      $sivuja = ceil($lkm/$montakosivulla);
      $drinkit = Drinkki::etsiDrinkitTyypilla($drinkkityyppi, $sivu, $montakosivulla);
  }
  if (!empty($nimi)) {
      $lkm = Drinkki::nimimaara($nimi);
      $sivuja = ceil($lkm/$montakosivulla);
      $drinkit = Drinkki::etsiNimi($nimi, $sivu, $montakosivulla);
  }
 
  naytaNakyma('drinkkilista.php', array(
    'drinkit' => $drinkit,
    'sivu' => $sivu,
    'sivuja' => $sivuja,
    'montakosivulla' => $montakosivulla,
    'lkm' => $lkm,
    'drinkkityyppi' => $drinkkityyppi,
    'nimi' => $nimi,
    'ehdotus' => $ehdotus
  ));
   
