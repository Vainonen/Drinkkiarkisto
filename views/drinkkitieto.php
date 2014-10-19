<div class="container">
        
<?php foreach($data->drinkki as $drinkki): ?>
  <h2><?php echo $drinkki->getNimi(); ?></h2>
  <div class="drinkki">
    <table class="table table-striped">
        <col width="120">     
      <tbody>
      <tr>
        <td>
          Muut nimitykset:
        </td>
        <td>
          <?php echo $drinkki->getAliakset() ?>
        </td>
      </tr>
      <tr>
        <td>
          Tyyppi:
        </td>
        <td>
          <?php echo $drinkki->getDrinkkityyppi() ?>
        </td>
      </tr>
      <tr>
        <td>
          Valmistustapa:
        </td>
        <td>
          <?php echo $drinkki->getValmistustapa() ?>
        </td>
      </tr>
      <tr>
        <td>
          Ainesosat:
        </td>
        <td>
          <?php foreach($data->ainesosat as $ainesosa): ?>
          <?php echo $ainesosa->getTilavuus();
          echo (' cl ');
          echo $ainesosa->getNimi(); 
          ?>
          <br>
          <?php endforeach; ?> 
        </td>
      </tr>
      </tbody>
    </table>
       <div class="form-group">
        <form class="form-horizontal" role="form" action="muokkaa.php" method="POST">
            <button type="submit" name="id" value="<?php echo $drinkki->getDrinkkiId(); ?>" class="btn btn-xs btn-default">
                <?php if ($drinkki->getEhdotus()==1) echo 'Tarkista ja hyväksy resepti'; else echo 'Muokkaa reseptiä'; ?>
            </button>
        </form>
        <form class="form-horizontal" role="form" action="poisto.php" method="POST">
            <button type="submit" name="id" value="<?php echo $drinkki->getDrinkkiId(); ?>" class="btn btn-xs btn-default">
                <?php if ($drinkki->getEhdotus()==1) echo 'Poista ehdotus'; else echo 'Poista resepti'; ?>
            </button> 
        </form>
     </div>
    
<?php endforeach; ?>
  </div>
</div>
   