<?php
  session_start();
  /* Näyttää näkymätiedoston ja lähettää sille muuttujat */
  function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require_once 'views/pohja.php';
    exit();
  }
  
  function naytaNakymaTieto($sivu, $data) {
    $data = (object)$data;
    require_once 'views/pohja.php';
    exit();
  }
 
   /* Tarkistaa onko käyttäjä kirjautunut */
   function kirjautunutko() {
      if (isset($_SESSION['kirjautunut'])) 
    return true;
    else return false;
  }
  
  /* Tarkistaa onko käyttäjällä oikeus muokauta drinkkireseptejä */
  function oikeusMuokata() {
      if (isset($_SESSION['muokkausoikeus']))
    return true;
    else return false;
  }
  
  /* Tarkistaa onko käyttäjällä oikeus muokata muiden käyttäjien tietoja */
  function oikeusModeroida() {
      if (isset($_SESSION['adminoikeus']))
    return true;
    else return false;
  }
  
  /* Käyttäjän uloskirjautuminen, tietojen ja evästeen poistaminen sessiosta */
  function kirjauduUlos () {
      session_start();
      $_SESSION = array();
      setcookie(session_name(), '', time() - 2592000, '/');
      session_destroy();
  header('Location: login.php');
  }
  
  /* huolehtii käyttäjän syötteiden puhdistamisesta */
  function sanitoi($merkit) {
    return htmlspecialchars(trim($merkit));
  } 