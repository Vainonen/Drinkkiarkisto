   <div class="container">
    <?php foreach($data->drinkki as $drinkki): ?>
    <h2>   
       <?php if ($drinkki->getEhdotus()==1) echo 'Reseptiehdotus';
              else echo 'Muokkaa drinkkireseptiä';
        ?> 
    </h2>
    <form class="form-horizontal" role="form" action="lisays.php?drinkki_id=<?php echo $drinkki->getDrinkkiId() ?>" method="POST">
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
        <label for="aliakset" class="col-md-2 control-label">Vaihtoehtoiset nimet</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputAliakset1" name="aliakset" value="<?php echo $drinkki->getAliakset(); ?>">
        </div>
        <?php if (!empty($data->virheet)): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['aliakset']; ?></div>
        <?php endif; ?>
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
        <?php if (!empty($data->virheet)): ?>
            <div class="alert alert-danger">
                <?php echo $data->virheet['valmistustapa']; ?>
            </div>
        <?php endif; ?>
      </div>
      <?php foreach ($data->virheet as $virhe): ?>
        <div class="alert alert-danger">
        <?php echo $virhe; ?></div>
        <?php endforeach; ?>
        
        <?php if (!empty($data->ainevirheet['tilavuus'])): ?>
            <div class="alert alert-danger">
                <?php echo $data->ainevirheet['tilavuus']; ?></div>
        <?php endif; ?>
        <?php if (!empty($data->ainevirheet['raakaaine'])): ?>
            <div class="alert alert-danger">
                <?php echo $data->ainevirheet['raakaaine']; ?></div>
        <?php endif; ?>
         <?php if (!empty($data->ainevirheet['maara'])): ?>
            <div class="alert alert-danger">
                <?php echo $data->ainevirheet['maara']; ?></div>
        <?php endif; ?>

      <?php foreach($data->ainesosat as $ainesosa): ?>
            <div class="form-group">
                <label for="ainesosat" class="col-md-2 control-label"><?php if ($i==0) echo 'Ainesosat';?></label>       
            <div class="control-label col-xs-1">
                <input type="text" class="form-control" id="inputTilavuus" name="tilavuus[]" value="<?php echo $ainesosa->getTilavuus();?>">
            </div>
            <label for="tilavuus[]" class="control-label">senttilitraa  </label>
            <select name="raakaaine[]">
                <option value="<?php echo $ainesosa->getAineId(); ?>" selected="selected"><?php echo $ainesosa->getNimi(); ?></option>
                    <?php foreach(Raakaaine::etsiKaikkiRaakaaineet() as $raakaaine): ?>
                         <option value="<?php echo $raakaaine->getAineId();?>"><?php echo $raakaaine->getNimi(); ?></option>
                    <?php endforeach; ?>
                </select>  
            </div> 
      <?php endforeach; ?>

        
     
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default" name="tallenna" value="vanha">
            <?php if ($drinkki->getEhdotus()==1) echo 'Hyväksy resepti'; else echo 'Tallenna resepti'; ?>
          </button>
        </div>
      </div>
        
    </form>
 <?php endforeach; ?>
       
  </div>


