<div class="container">
        
    <h2>Drinkki</h2>
<?php foreach($data->drinkki as $drinkki): ?>
<div class="drinkki">
    nimi:
    <?php echo $drinkki->getNimi(); ?>
    <br>
    muut nimitykset: 
    <?php echo $drinkki->getAliakset() ?>
    <br>
    tyyppi:
    <?php echo $drinkki->getDrinkkityyppi() ?>
    <br>
    valmistustapa:
    <?php echo $drinkki->getValmistustapa() ?>
    <br>
 <?php endforeach; ?>
    
 <?php foreach($data->ainesosat as $ainesosa): ?>
       <?php echo $ainesosa->getTilavuus();
       echo (' cl ');
       echo $ainesosa->getNimi(); 
       ?>
    <br>
<?php endforeach; ?>
    
    <a href="update.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>">Muokkaa reseptiä</a>
    <a href="poisto.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>">Poista resepti</a>
</div>
   