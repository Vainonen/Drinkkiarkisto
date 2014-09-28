   <div class="container">
        <br><br><br><br><br><br><br>
    <h2>Lisää drinkkiresepti</h2>
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
        <label for="aliakset" class="col-md-2 control-label">Vaihtoehtoiset nimet (erota pilkuin) </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputAliakset1" name="aliakset">
        </div>
      </div>
      <div class="form-group">
        <label for="tyyppi" class="col-md-2 control-label">Drinkkityyppi </label>
        <div class="col-md-10">
        <div class="btn-group">
            <input type="radio" name="drinkkityyppi" value="Cocktail"> Cocktail
            <input type="radio" name="drinkkityyppi" value="Shotti"> Shotti
            <input type="radio" name="drinkkityyppi" value="Long Drink"> Long Drink
        </div>
        </div>
        </div>
        <div class="form-group">
        <label for="aliakset" class="col-md-2 control-label">Valmistustapa </label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputValmistustavat1" name="valmistustapa">
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
          <button type="submit" class="btn btn-default">Tallenna resepti</button>
        </div>
      </div>
        
    </form>
  </div>

