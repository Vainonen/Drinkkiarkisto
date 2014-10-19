<div class="container">
        
    <h2>
       Drinkit
    </h2>
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
              <a href="hae.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>"><?php echo $drinkki->getNimi() ?></a>
          </td>
          <td>
              <a href="drinkit.php?drinkkityyppi=<?php echo $drinkki->getDrinkkityyppi(); ?>"><?php echo $drinkki->getDrinkkityyppi() ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>