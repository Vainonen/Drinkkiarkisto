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
         <div class="container">
    <div class="row">
      <div class="col-md-3">      
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <h2><a href="index.php">DRINKKIARKISTO</a></h2>
        <div class="container">
            <h3>
            <a href="#">Drinkkityypit |</a>
            <a href="#"> Ainesosat |</a>
            <a href="drinkit.php"> Listaa kaikki |</a>
            <a href="insert.php"> Lisää drinkki</a> 
            <?php if (oikeusModeroida()): ?>
                <a href="usershow.php">| Käyttäjät</a>      
            <?php endif; ?>
            </h3>
            <p style="text-align:right">

            <?php if (kirjautunutko()): ?>
                <?php echo $_SESSION['kayttajatunnus']; ?>
                <a href="logout.php">Kirjaudu ulos</a>      
            <?php endif; ?>
            <?php if (!kirjautunutko()): ?>
            <a href="login.php">Kirjaudu |</a>
            <a href="#">Rekisteröidy</a>
            <?php endif; ?>
            </p>        
        </div>
        </nav>
        </div>
      </div>
             <br><br><br><br><br><br><br>
               <?php if (!empty($data->virhe)): ?>
               <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
               <?php endif; ?>
               <?php if (!empty($_SESSION['ilmoitus'])): ?>
                <div class="alert alert-danger">      
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
       </div>
              
</body>
</html>
