 <div class="container">
      
    <h2>Kirjaudu</h2>
    <form class="form-horizontal" role="form" action="users.php" method="POST">
      <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">Käyttäjätunnus</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="inputEmail1" name="username">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Muista kirjautuminen
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Kirjaudu sisään</button>
        </div>
      </div>
    </form>
  </div>
 
<?php if (!empty($data->virhe)): ?>
  <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
