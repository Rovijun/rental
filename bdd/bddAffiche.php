<?php
  include ("fonction/lib.php");
  errorLog();

  //Connexion BDD
  $bdd = connectDB();

  //recup Voiture
  $voiture = afficheVoiture();

?>

<div class="row">
  <table class="table table-striped table-dark">
      <thead>
          <tr>
              <th>Marques</th>
              <th>Types</th>
              <th>Images</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($voiture as $Search) { ?>
              <tr>
                  <td><?=$Search['Marque']?></td>
                  <td><?=$Search['Nom']?></td>
                  <td>
                      <a href="#"><img src="assets/img/<?=$Search['Image']?>" class="img-fluid imgCar"/></a>
                  </td>
              </tr>
          <?php } ?>
      </tbody>
  </table>
</div>
