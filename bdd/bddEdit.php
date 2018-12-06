<?php
  include ("fonction/lib.php");
  errorLog();

  //Connexion BDD
  $bdd = connectDB();

  //recup Voiture
  $voiture = afficheVoitureAll();

  //$voit = afficheVoiture();
  //recup Voiture
  $agence = afficheAgence();
  $type = afficheType();
  $image = afficheImage();

?>

<form class="" action="traitModif.php" method="post">
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
              <tr>
                  <td><?=$Search['Marque']?></td>
                  <td><?=$Search['Nom']?></td>
                  <td><?=$Search['Agence']?></td>
                  <td>
                    <img src="assets/img/<?=$Search['Image']?>" class="img-fluid imgCar"/>
                  </td>
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="choix[]" value="<?=$Search['idVOITURE']?>">
                      <input class="btn btn-danger" type="submit" name="btnEdit" value="Éditer">
                    </div>
                  </td>
              </tr>
          <?php } ?>
      </tbody>
  </table>
</form>
