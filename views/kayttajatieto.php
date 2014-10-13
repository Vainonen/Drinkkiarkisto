   <div class="container">
        
    <h2>Käyttäjä</h2>
    <?php foreach($data->kayttaja as $kayttaja): ?>

    <div class="form-group">
        <label for="nimi" class="col-md-2 control-label">Käyttäjätunnus: </label><?php echo $kayttaja->getTunnus(); ?>
      </div>
      <div class="form-group">
        <label for="muokkausoikeus" class="col-md-2 control-label">Reseptin muokkausoikeus</label>
        <div class="col-md-10">
         <input type="checkbox" name="muokkausoikeus" value="1" <?php if ($kayttaja->getMuokkausoikeus()) print 'checked'; ?>> 
        </div>
      </div>
      <div class="form-group">
        <label for="muokkausoikeus" class="col-md-2 control-label">Käyttäjien moderointioikeus</label>
        <div class="col-md-10">
         <input type="checkbox" name="adminoikeus" value="1" <?php if ($kayttaja->getAdminoikeus()) print 'checked'; ?>> 
        </div>
      </div>
        
<?php endforeach; ?>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default" name="tallenna" value="tallenna">Tallenna muutokset</button>
          <button type="submit" class="btn btn-default" name="tallenna" value="poista">Poista käyttäjä</button>
        </div>
      </div>  
    
</div>