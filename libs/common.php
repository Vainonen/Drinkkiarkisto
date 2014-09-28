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
  
  function kirjautunutko() {
      if (isset($_SESSION['kirjautunut'])) 
    return true;
    else return false;
    
 
    
  function kirjauduUlos () {
      unset($_SESSION["kirjautunut"]);
  //Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
  header('Location: login.php');
  }
  }