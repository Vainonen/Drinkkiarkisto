<div class="container">
  <h2><?php echo $data->kayttaja->getTunnus(); ?></h2>
  <form class="form-horizontal" role="form" action="kayttajamuutos.php?kayttaja_id=<?php echo $data->kayttaja->getId() ?>" method="POST">
    <table class="table table-striped">
        <col width="300">     
      <tbody>
      <tr>
        <td>
          Reseptien muokkausoikeus
        </td>
        <td>
            <div class="form-group">
                
         <input type="checkbox" name="muokkausoikeus" value=1 <?php if ($data->kayttaja->getMuokkausoikeus()==1) print 'checked'; ?>> 
        
            </div>
        </td>
      </tr>
      <tr>
        <td>
          Käyttäjätietojen muokkausoikeus
        </td>
        <td>
          <div class="form-group">    
            <input type="checkbox" name="adminoikeus" value=1 <?php if ($data->kayttaja->getAdminoikeus()==1) print 'checked'; ?>> 
            </div>
        </td>
      </tr>
      <tr>
        <td>
          Anna käyttäjälle uusi salasana:
        </td>
        <td>
          <div class="form-group">
            <input type="password" class="form-control" id="inputPassword1" name="salasana" value="<?php echo $data->kayttaja->getSalasana(); ?>">
          </div>
          <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
          <?php endif; ?>
        </td>
      </tr>
      </tbody>
    </table>
        <button type="submit" name="tallenna" value="tallenna" class="btn btn-xs btn-default">Tallenna muutokset</button>
        <button type="submit" name="tallenna" value="poista" class="btn btn-xs btn-default">Poista käyttäjä</button>    
  </form>
</div> 