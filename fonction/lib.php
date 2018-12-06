<?php
  function errorLog(){
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
  }

  function connectDB(){
    $user = "student";
    $pass = "M0t_de_passe";
    try {
    	$bdd = new PDO('mysql:host=localhost;dbname=rental', $user, $pass);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch(Exception $e) {
    	// En cas d'erreur, on affiche un message et on arrête tout
      die('Erreur : '.$e->getMessage());
    }
    return $bdd;
  }

// LES AFFICHES ET MANIPULATIONS DES DONNEES
  //Recup Toutes les colonnes et les lignes de tab VOITURE (dans bddDelete)
  function afficheVoitureAll(){
    $bdd = connectDB();
    //recup Voiture
    $sql = 'SELECT VOITURE.idVOITURE, VOITURE.Marque, TYPE_VOITURE.Nom, AGENCE.Nom AS Agence,
    VOITURE.Image FROM VOITURE INNER JOIN TYPE_VOITURE
    ON VOITURE.idTYPE_VOIT = TYPE_VOITURE.idTYPE_VOIT
    INNER JOIN AGENCE ON VOITURE.idAGENCE = AGENCE.idAGENCE
    ORDER BY VOITURE.idVOITURE';
    $req = $bdd->prepare($sql);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  function afficheVoiture(){
    $bdd = connectDB();
    //recup Voiture pour Affiche
    $sql = 'SELECT VOITURE.Marque, TYPE_VOITURE.Nom, VOITURE.Image
      FROM VOITURE INNER JOIN TYPE_VOITURE
      ON VOITURE.idTYPE_VOIT = TYPE_VOITURE.idTYPE_VOIT
      ORDER BY VOITURE.Marque';
    $req = $bdd->prepare($sql);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  function afficheAgence(){
    $bdd = connectDB();
    //recup Agence Column Nom
    $sql = 'SELECT Nom FROM AGENCE';
    $req = $bdd->prepare($sql);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  function afficheType(){
    $bdd = connectDB();
    //recup Type Column Nom
    $sql = 'SELECT Nom FROM TYPE_VOITURE';
    $req = $bdd->prepare($sql);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  function afficheImage(){
    $bdd = connectDB();
    //recup Column Image
    $sql = 'SELECT Image FROM VOITURE';
    $req = $bdd->prepare($sql);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  function selectAgenceId($input1){
    $bdd = connectDB();
    //recup idAgence
    $sql = 'SELECT idAGENCE FROM AGENCE WHERE Nom = :agence';
    $req = $bdd->prepare($sql);
    $req->bindParam(':agence', $input1, PDO::PARAM_STR);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_COLUMN);
    $req->closeCursor();
    return $results;
  }

  function selectTypeId($input2){
    $bdd = connectDB();
    //recup idTYpe
    $sql = 'SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE Nom = :type';
    $req = $bdd->prepare($sql);
    $req->bindParam(':type', $input2, PDO::PARAM_STR);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_COLUMN);
    $req->closeCursor();
    return $results;
  }

  //Recup Row TAble Voiture
  function selectVoitAll($input3){
    $bdd = connectDB();
    $sql = 'SELECT VOITURE.idVOITURE, VOITURE.Marque, AGENCE.Nom AS Agence,
      TYPE_VOITURE.Nom AS Type, VOITURE.Image
      FROM VOITURE INNER JOIN AGENCE
      ON AGENCE.idAGENCE = VOITURE.idAGENCE
      INNER JOIN TYPE_VOITURE
      ON TYPE_VOITURE.idTYPE_VOIT = VOITURE.idTYPE_VOIT
      WHERE idVOITURE = :idVoit';
    $req = $bdd->prepare($sql);
    $req->bindParam(':idVoit', $input3, PDO::PARAM_STR);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

// CRUD *****
  // Recherche
  function searchVoiture($input){
    $bdd = connectDB();
    //recup Voiture
    $sql = 'SELECT VOITURE.Marque, TYPE_VOITURE.Nom,
      AGENCE.Nom AS Agence, VOITURE.Image
      FROM VOITURE INNER JOIN TYPE_VOITURE
      ON VOITURE.idTYPE_VOIT = TYPE_VOITURE.idTYPE_VOIT
      INNER JOIN AGENCE ON VOITURE.idAGENCE = AGENCE.idAGENCE
      WHERE (VOITURE.Marque LIKE :recherche
        || TYPE_VOITURE.Nom LIKE :recherche
        || AGENCE.Nom LIKE :recherche
        || VOITURE.Image LIKE :recherche)';
    $req = $bdd->prepare($sql);
    $req->bindParam(':recherche', $input, PDO::PARAM_STR);
    $req->execute(array(':recherche' => '%'.$input.'%'));
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  //Input new article
  function ajoutVoiture($input, $input1, $input2, $input3){
    $bdd = connectDB();
    //Ajout Voit
    $sql = "INSERT INTO `VOITURE` (Marque, idAGENCE, idTYPE_VOIT, Image)
      VALUES (:marque, (SELECT idAGENCE FROM AGENCE WHERE idAGENCE = :idAgence),
      (SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE idTYPE_VOIT = :idType), :image)";
    $req = $bdd->prepare($sql);
    $req->bindParam(':marque', $input, PDO::PARAM_STR);
    $req->bindParam(':idAgence', $input1, PDO::PARAM_INT);
    $req->bindParam(':idType', $input2, PDO::PARAM_INT);
    $req->bindParam(':image', $input3, PDO::PARAM_STR);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $results;
  }

  //Delete multiple articles
  function deleteVoiture($input){
    $bdd = connectDB();
    //Supr Voit
    $sql = 'DELETE FROM `VOITURE`
      WHERE idVOITURE IN (:id)';
    $req = $bdd->prepare($sql);
    $req->bindValue(':id', $input, PDO::PARAM_INT);
    $req->execute();
    $results = $req->fetchAll();
    $req->closeCursor();
    return $results;
  }

  //Modification de la table Voiture (MAJ)
  function updateVoiture($input, $input1, $input2, $input3, $input4){
    $bdd = connectDB();
    //Update Voit
    $sql = 'UPDATE VOITURE SET VOITURE.Marque = :marque,
      VOITURE.idAGENCE = (SELECT idAGENCE FROM AGENCE WHERE AGENCE.Nom = :agence),
      VOITURE.idTYPE_VOIT = (SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE TYPE_VOITURE.Nom = :type),
      VOITURE.Image = :image WHERE VOITURE.idVOITURE = :idVoit';
    $req = $bdd->prepare($sql);
    $req->bindParam(':marque', $input, PDO::PARAM_STR);
    $req->bindParam(':agence', $input1, PDO::PARAM_STR);
    $req->bindParam(':type', $input2, PDO::PARAM_STR);
    $req->bindParam(':image', $input3, PDO::PARAM_STR);
    $req->bindValue(':idVoit', $input4, PDO::PARAM_INT);
    $req->execute();
    $results = $req->fetchAll();
    $req->closeCursor();
    return $results;
  }
