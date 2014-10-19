<!DOCTYPE html>
<html>
    <head>
        <title>Drinkkiarkisto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>
  <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Drinkkiarkisto</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="ainekset.php">Ainesosat</a></li>
        <li><a href="drinkit.php">Kaikki drinkit</a></li> 
        <?php if (kirjautunutko() && !oikeusMuokata()): ?>
        <li><a href="lisaa.php?ehdotus=1">Tee reseptiehdotus</a></li>  
        <?php endif; ?>
        <?php if (oikeusMuokata()): ?>
        <li><a href="lisaa.php">Lisää drinkki</a></li>
        <li><a href="drinkit.php?ehdotus=1">Reseptiehdotukset</a></li> 
        <?php endif; ?>
        <?php if (oikeusModeroida()): ?>
        <li><a href="kayttajat.php">Käyttäjät</a></li>      
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (kirjautunutko()): ?>
        <li><?php echo $_SESSION['kayttajatunnus']; ?></li>
        <li><a href="poistu.php">Kirjaudu ulos</a></li>    
        <?php endif; ?>
        <?php if (!kirjautunutko()): ?>
        <li><a href="kirjaudu.php">Kirjaudu</a></li>
        <li><a href="rekisteroidy.php">Rekisteröidy</a></li>
        <?php endif; ?>         
      </ul>
    </div>
  </div>
</nav>

               <?php if (!empty($_SESSION['ilmoitus'])): ?>
                <div class="alert alert-success">      
                <?php echo $_SESSION['ilmoitus']; ?>
                </div>
                <?php
                // Samalla kun viesti näytetään, se poistetaan istunnosta,
                // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
                unset($_SESSION['ilmoitus']); ?>
                <?php endif;?>             
               <?php            
               require_once 'views/'.$sivu;
               ?>
                  
</body>
</html>
