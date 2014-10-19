 <div class="container">
      
    <h2>Rekisteröidy</h2>
    <form class="form-horizontal" role="form" action="rekisterointi.php" method="POST">
      <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">Käyttäjätunnus</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputEmail1" name="username">
        </div>
        <?php if (!empty($data->virheet['tunnus'])): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['tunnus']; ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password1">
        </div>
        <?php if (!empty($data->virheet['salasana'])): ?>
        <div class="alert alert-danger">
        <?php echo $data->virheet['salasana']; ?></div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Kirjoita salasana uudestaan</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password2">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Rekisteröidy</button>
        </div>
      </div>
    </form>
  </div>
    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
