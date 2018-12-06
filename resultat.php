<?php
  include ("fonction/lib.php");
  //errorLog(); Je là desactive pour la recherche vide
  include "template/header.php";
  include "template/menu.php";

  //Connexion BDD
  $bdd = connectDB();
?>
<h3>Résultat de la recherche :</h3>

<?php
  if (isset($_POST['recherche'])){
    if (empty($_POST['recherche'])) {
      ?>
        <script type="text/javascript">
          alert("Veuillez recommencer votre recherche PEACE :D");
        </script>
      <?php
    }
      else {
        $filtreInput = filter_var($_POST['recherche'], FILTER_SANITIZE_STRING);

        $tab = array(
            ':recherche'  => $filtreInput
        );

        searchVoiture($filtreInput);
        //affectation de la fonction searchVoiture -> Variable
        $voit = searchVoiture($filtreInput);
      }
  }
?>

<div class="row">
  <table class="table table-striped table-dark">
      <thead>
          <tr>
              <th>Marques</th>
              <th>Types</th>
              <th>Agences</th>
              <th>Images</th>
          </tr>
      </thead>
      <tbody><?php
        if (!$voit) {
            ?>
              <td>Recherche introuvable</td>
              <td>Recherche introuvable</td>
              <td>Recherche introuvable</td>
              <td>Recherche introuvable</td>
            <?php
        } else {
           foreach ($voit as $Search) { ?>
              <tr>
                  <td><?=$Search['Marque']?></td>
                  <td><?=$Search['Nom']?></td>
                  <td><?=$Search['Agence']?></td>
                  <td>
                    <img src="assets/img/<?=$Search['Image']?>" class="img-fluid imgCar"/>
                  </td>
              </tr>
          <?php }
         } ?>
      </tbody>
  </table>
</div>

<?php include "template/footer.php"; ?>
