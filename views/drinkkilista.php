<div class="container">
        
    <h2>Drinkit</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nimi</th>
          <th>Tyyppi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach($data->drinkit as $drinkki): ?>
  
          <td>
              <a href="search.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>"><?php echo $drinkki->getNimi() ?></a>
          </td>
          <td>
              <?php echo $drinkki->getDrinkkityyppi(); ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

<br><br>
<?php if ($data->sivu > 1): ?>
    <a href="drinkit.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
    <a href="drinkit.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
<?php endif; ?>
<br><br>Näytetään drinkit: 
<?php echo ($data->sivu-1)*$data->montakosivulla+1  ?>
 &nbsp;-&nbsp;
<?php echo ($data->sivu-1)*$data->montakosivulla+sizeof($data->drinkit) ?>
 &nbsp;yhteensä&nbsp;
<?php echo $data->lkm ?>
 &nbsp;drinkistä.
    </div>