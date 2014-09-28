<div class="container">
        <br><br><br><br><br><br><br>
    <h2>Käyttäjät</h2>
    <?php foreach($data->kayttajat as $kayttaja): ?>
<div class="kayttaja">
  Käyttäjätunnus on
  <?php echo $kayttaja->getTunnus(); ?>
  <a href="Kissa?id=<?php echo $kayttaja->getId() ?>"><?php echo $kayttaja->getNimi() ?></a>
</div>
<?php endforeach; ?>
 

