<?php
  include ("fonction/lib.php");
  //errorLog(); Je désactive pour le visuel mais ça marche nickel ;)
  //Connexion BDD
  $bdd = connectDB();

  //recup Voiture
  $agence = afficheAgence();
  $type = afficheType();
  $image = afficheImage();
?>

<form enctype="multipart/form-data" action="ajout.php" method="post">
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
  <div class="col-md-2">
    <input class="btn btn-danger" type="submit" value="Ajouter"/>
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

      $idType = selectTypeId($resType);
      $idAgence = selectAgenceId($resAgence);

      foreach ($idAgence as $valeur1){
        foreach ($idType as $valeur2){
        $tab = array(
            ':marque'  => $filtreInput,
            ':idAgence' => $valeur1,
            ':idType' => $valeur2
        );
        ajoutVoiture($filtreInput, $valeur1, $valeur2, $images);
        }
      }
    //  print_r($_POST); // Oufffff Enfin ! Happy :D
    //  print_r($tab);

    //  print_r(selectTypeId($resType));
      //print_r(selectAgenceId($resAgence));
    }
?>
