<?php
/* tarkistaa kirjautumislomakkeesta palautettujen tietojen oikeellisuuden
 * eli käyttäjätunnuksen ja salasanan
 */

session_start();
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';
  //Tarkistetaan että vaaditut kentät on täytetty:
  if (empty($_POST["username"])) {
    naytaNakyma('kirjautuminen.php', array(
      'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
  }
  $tunnus = sanitoi($_POST["username"]);

  if (empty($_POST["password"])) {
    naytaNakyma('kirjautuminen.php', array(
      'kayttaja' => $tunnus,
      'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
  }
  $salasana = sanitoi($_POST["password"]);
  
  $kayttaja = Kayttaja::etsiKayttajaTunnuksilla($tunnus, $salasana);

  /* Tarkistetaan onko parametrina saatu oikeat tunnukset */
  if ($kayttaja != null) {
    $_SESSION['kirjautunut'] = $kayttaja;
    if ($kayttaja->getMuokkausoikeus()==true) $_SESSION['muokkausoikeus'] = true;
    if ($kayttaja->getAdminoikeus()==true) $_SESSION['adminoikeus'] = true;
    $_SESSION['kayttajatunnus'] = $kayttaja->getTunnus();
    header('Location: login.php');
    

  } else {
    /* Väärän tunnuksen syöttänyt saa eteensä lomakkeen ja virheen.
     * Tässä käytetään omassa kirjastotiedostossa määriteltyjä yleiskäyttöisiä funktioita.
     */
    naytaNakyma('kirjautuminen.php', array(
      /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
      'kayttaja' => $tunnus,
      'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
    ));
  }