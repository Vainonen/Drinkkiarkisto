   <div class="container">
    <h2>   
       <?php if ($data->ehdotus==1) echo 'Tee reseptiehdotus';
              else echo 'Lisää drinkkiresepti';
        ?> 
    </h2>
    <form class="form-horizontal" role="form" action="lisays.php" method="POST">
      <div class="form-group">
        <label for="nimi" class="col-md-2 control-label">Drinkin nimi</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputNimi1" name="nimi">
        </div>
        <?php if (!empty($data->virheet)): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['nimi']; ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="aliakset" class="col-md-2 control-label">Vaihtoehtoiset nimet</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputAliakset1" name="aliakset">
        </div>
        <?php if (!empty($data->virheet['aliakset'])): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['aliakset']; ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="tyyppi" class="col-md-2 control-label">Drinkkityyppi </label>
        <div class="col-md-10">
        <div class="btn-group">
            <input type="radio" name="drinkkityyppi" value="Cocktail" checked> Cocktail
            <input type="radio" name="drinkkityyppi" value="Shotti"> Shotti
            <input type="radio" name="drinkkityyppi" value="Long Drink"> Long Drink
        </div>
        </div>
        </div>
        <div class="form-group">
        <label for="valmistustavat" class="col-md-2 control-label">Valmistustapa </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputValmistustavat1" name="valmistustapa">
        </div>
        <?php if (!empty($data->virheet['valmistustapa'])): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['valmistustapa']; ?></div>
        <?php endif; ?>
      </div>
       
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
        
       <?php for ($i=0; $i<5; $i++): ?>
            <div class="form-group">
                <label for="ainesosat" class="col-md-2 control-label"><?php if ($i==0) echo 'Ainesosat';?></label>       
              <div class="control-label col-xs-1">
                <input type="text" class="form-control" id="inputTilavuus" name="tilavuus[]">
              </div>
                
                <label for="tilavuus[]" class="control-label">senttilitraa  </label>
                    <select name="raakaaine[]">
                        <option value="" selected="selected">Valitse raaka-aine</option>
                    <?php foreach(Raakaaine::etsiKaikkiRaakaaineet() as $raakaaine): ?>
                        <option value="<?php echo $raakaaine->getAineId();?>"><?php echo $raakaaine->getNimi(); ?></option>
                    <?php endforeach; ?>
                    </select>  
            </div> 
            
        <?php endfor; ?>
        
        <br>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default" name="tallenna" value="<?php if ($data->ehdotus==1) echo 'ehdotus'; else echo 'uusi'; ?>">
          <?php if ($data->ehdotus==1) echo 'Lähetä reseptiehdotus';
              else echo 'Tallenna resepti';
          ?>
          </button>
        </div>
      </div>
        
    </form>
  </div>

