<?php
  include ("fonction/lib.php");
  errorLog();

  //Connexion BDD
  $bdd = connectDB();

  //recup Voiture
  $voiture = afficheVoitureAll();

?>

<form class="" action="supprimer.php" method="post">
  <table class="table table-striped table-dark">
      <thead>
          <tr>
              <th>Marques</th>
              <th>Types</th>
              <th>Agences</th>
              <th>Images</th>
              <th>Sélectionner</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($voiture as $Search) { ?>
              <tr for="check">
                  <td><?=$Search['Marque']?></td>
                  <td><?=$Search['Nom']?></td>
                  <td><?=$Search['Agence']?></td>
                  <td>
                    <img src="assets/img/<?=$Search['Image']?>" class="img-fluid imgCar"/>
                  </td>
                  <td>
                    <div class="form-check ckbox">
                      <input class="form-check-input" id="check" type="checkbox" name="choix[]" value="<?=$Search['idVOITURE']?>">
                      <label for="check"></label>
                    </div>
                  </td>
              </tr>
          <?php } ?>
      </tbody>
  </table>
  <div class="row d-flex justify-content-end">
    <input class="btn btn-danger btnSup" type="submit" value="Supprimer">
  </div>
</form>

  <?php
  if(isset($_POST['choix']) && is_array($_POST['choix'])){
    foreach ($_POST['choix'] as $multi) {
    $tab = array(
        ':id'  => $multi
    );
    deleteVoiture($multi);
    }
    //print_r($_POST); pour vérifier l'entrée
  }
  ?>
