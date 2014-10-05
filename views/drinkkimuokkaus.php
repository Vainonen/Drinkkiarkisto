   <div class="container">
        
    <h2>Muokkaa drinkkireseptiä</h2>
    <?php foreach($data->drinkki as $drinkki): ?>
    <form class="form-horizontal" role="form" action="muokkaus.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>" method="POST">
      <div class="form-group">
        <label for="nimi" class="col-md-2 control-label">Drinkin nimi</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputNimi1" name="nimi" value="<?php echo $drinkki->getNimi(); ?>">
        </div>
        <?php if (!empty($data->virheet)): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['nimi']; ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="aliakset" class="col-md-2 control-label">Vaihtoehtoiset nimet (erota pilkuin) </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputAliakset1" name="aliakset" value="<?php echo $drinkki->getAliakset(); ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="tyyppi" class="col-md-2 control-label">Drinkkityyppi </label>
        <div class="col-md-10">
        <div class="btn-group">
            <input type="radio" name="drinkkityyppi" value="Cocktail" <?php if ($drinkki->getDrinkkityyppi()=="Cocktail") print 'checked'; ?>> Cocktail
            <input type="radio" name="drinkkityyppi" value="Shotti" <?php if ($drinkki->getDrinkkityyppi()=="Shotti") print 'checked'; ?>> Shotti
            <input type="radio" name="drinkkityyppi" value="Long Drink" <?php if ($drinkki->getDrinkkityyppi()=="Long Drink") print 'checked'; ?>> Long Drink
        </div>
        </div>
        </div>
        <div class="form-group">
        <label for="aliakset" class="col-md-2 control-label">Valmistustapa </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputValmistustavat1" name="valmistustapa" value="<?php echo $drinkki->getValmistustapa(); ?>">
        </div>
      </div>
        <!--
      <div class="form-group">
        <label for="ainesosa" class="col-md-2 control-label">Ainesosa </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputAinesosa1">
          <button type="button" class="btn btn-default">Lisää aineksia</button>
        </div>
      </div>
        -->
        
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default" name="tallenna" value="tallenna">Tallenna resepti</button>
          
        </div>
      </div>
        
    </form>
  </div>

 <?php endforeach; ?>