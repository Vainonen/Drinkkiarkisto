<div class="container">
        <br><br><br><br><br><br><br>
    <h2>Drinkit</h2>
    <?php foreach($data->drinkit as $drinkki): ?>
<div class="drinkki">
<a href="search.php?id=<?php echo $drinkki->getDrinkkiId() ?>"><?php echo $drinkki->getNimi() ?></a>
<?php endforeach; ?>
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
    </div>