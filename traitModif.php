<?php
  include ("fonction/lib.php");
  //errorLog(); // Je là desactive pour la recherche vide
  include "template/header.php";
  include "template/menu.php";

  //Connexion BDD
  $bdd = connectDB();
  $voiture = afficheVoiture();
  //recup Voiture
  $agence = afficheAgence();
  $type = afficheType();
  $image = afficheImage();
?>

<h3>Modification voiture :</h3>

<?php
if(isset($_POST['choix'])){
  foreach ($_POST['choix'] as $multi) {
  $tab = array(
      ':idVoit'  => $multi
  );
    $res = selectVoitAll($multi);
  }
  //print_r($res); // Vérification des données entrées
}

?>

<form class="" action="" method="post">
  <table class="table table-striped table-dark">
      <thead>
          <tr>
              <th>Marques</th>
              <th>Types</th>
              <th>Agences</th>
              <th>Images</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($res as $Search) { ?>
              <tr>
                  <td><?=$Search['Marque']?></td>
                  <td><?=$Search['Type']?></td>
                  <td><?=$Search['Agence']?></td>
                  <td>
                    <img src="assets/img/<?=$Search['Image']?>" class="img-fluid imgCar"/>
                  </td>
              </tr>
          <?php } ?>
      </tbody>
  </table>
</form>

<form enctype="multipart/form-data" action="" method="post">
<div class="row">
  <div class="col-md-2">
    <input class="form-control" type="text" name="marque" placeholder="Marque"><br>
  </div>
  <div class="col-md-2">
    <select class="form-control" required name="type">
      <option disabled selected value="">Types</option>
      <?php foreach($type as $types) { ?>
      <option value="<?=$types['Nom']?>">
        <?=$types['Nom']?>
      </option>
      <?php } ?>
    </select>
  </div>
  <div class="col-md-2">
    <select class="form-control" required name="agence">
      <option disabled selected value="">Agences</option>
      <?php foreach($agence as $agences) { ?>
      <option value="<?=$agences['Nom']?>">
        <?=$agences['Nom']?>
      </option>
      <?php } ?>
    </select>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <input type="file" class="form-control-file border" name="image"/>
    </div>
  </div>
  <div class="form-check ckbox">
    <input class="form-check-input" id="check" type="checkbox" name="choice" value="<?=$Search['idVOITURE']?>">
    <label for="check">Cocher puis valider</label>
  </div>
  <div class="col-md-2">
    <input class="btn btn-danger" type="submit" value="Valider"/>
  </div>
</div>
</form>

<?php

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
// Testons si le fichier n'est pas trop gros
  if ($_FILES['image']['size'] <= 1000000)
  {
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
    if (in_array($extension_upload, $extensions_autorisees))
    {
      // On peut valider le fichier et le stocker définitivement
      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/img/' . basename($_FILES['image']['name']));
    }
  }
}

if (isset($_POST['marque'])){
  //Filtre les données entrées

  $filtreInput = filter_var($_POST['marque'], FILTER_SANITIZE_STRING);

  $images = basename($_FILES['image']['name']);

  $resType = $_POST['type'];
  $resAgence = $_POST['agence'];
  $resChoix = $_POST['choice'];

    $tabs = array(
        ':marque'  => $filtreInput,
        ':agence' => $resAgence,
        ':type' => $resType,
        ':image' => $images,
        ':idVoit' => $resChoix
    );

  updateVoiture($filtreInput, $resAgence, $resType, $images, $resChoix);
  //print_r($_POST); // Oufffff Enfin ! Happy :D
}

?>

<?php
  include "template/footer.php";
?>
