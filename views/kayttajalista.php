<div class="container">
        
    <h2>Käyttäjät</h2>
   
 
<div class="kayttaja">
    <form class="form-horizontal" role="form" action="kayttajakontrolleri.php" method="POST">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Käyttäjätunnus</th>
          <th>Reseptin muokkausoikeus</th>
          <th>Moderointioikeus</th>
          <th>Muokkaa tietoja</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach($data->kayttajat as $kayttaja): ?>
        <tr>
          <td><?php echo $kayttaja->getTunnus() ?></td>
  
          <td><?php if ($kayttaja->getMuokkausoikeus()) 
                echo "kyllä";
                else echo "ei"; ?> 
          </td>
          <td><?php if ($kayttaja->getAdminoikeus()) 
                echo "kyllä";
                else echo "ei"; ?>
          </td>
          <td><button type="submit" name="id" value="<?php echo $kayttaja->getId();?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></button></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </form>

    <br><br>
<?php if ($data->sivu > 1): ?>
<a href="usershow.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="usershow.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
<?php endif; ?>
<br><br>Näytetään käyttäjät: 
<?php echo ($data->sivu-1)*$data->montakosivulla+1  ?>
 &nbsp;-&nbsp;
<?php echo ($data->sivu-1)*$data->montakosivulla+sizeof($data->kayttajat) ?>
 &nbsp;yhteensä&nbsp;
<?php echo $data->lkm ?>
 &nbsp;käyttäjästä.
    </div>
    </div>