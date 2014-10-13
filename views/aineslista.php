<div class="container">
        
    <h2>Ainesosat</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Klikkaamalla nimeä, saat reseptejä, joissa raaka-ainetta on käytetty</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach($data->raakaaineet as $raakaaine): ?> 
          <td>
              <a href="list.php?raakaaine_id=<?php echo $raakaaine->getAineId() ?>"><?php echo $raakaaine->getNimi() ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>
