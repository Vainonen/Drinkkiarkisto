<div class="container">
        <br><br><br><br><br><br><br>
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
    <a href="update.php?id=<?php echo $drinkki->getDrinkkiId() ?>">Muokkaa reseptiä</a>
    <a href="poisto.php?id=<?php echo $drinkki->getDrinkkiId() ?>">Poista resepti</a>
</div>
    <?php endforeach; ?>