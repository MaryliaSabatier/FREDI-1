<?php
// Initialisations
$page = "lignes_frais_notes.php";
include 'init.php';
include 'sql.php';
include 'header.php';

//permet de rechercher les motifs
$sql = 'select * from motif ;';

try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array());
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

//permet de prendre toute les periode est_active

$sql = "SELECT * FROM periode WHERE est_active ='1' ;";

try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array());
  $tableaux = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}


// recuperation de toute les variable saisie dans le formulaire

$dat_ligne = isset($_POST['dat_ligne']) ? $_POST['dat_ligne'] : '';
$id_motif = isset($_POST['motif']) ? $_POST['motif'] : '';
echo '<br><br>';
echo $periode = isset($_POST['periode']) ? $_POST['periode'] : '';
$lib_trajet = isset($_POST['lib_trajet']) ? $_POST['lib_trajet'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$mt_peage = isset($_POST['mt_peage']) ? $_POST['mt_peage'] : '';
$mt_repas = isset($_POST['mt_repas']) ? $_POST['mt_repas'] : '';
$mt_hebergement = isset($_POST['mt_hebergement']) ? $_POST['mt_hebergement'] : '';

$submit = isset($_POST['submit']);

// Ajout dans la base
if ($submit) {

  $sql="INSERT INTO note (id_periode, id_utilisateur) VALUES (:id_periode ,:id_utilisateur)";
  try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array( ":id_periode" => $periode,
      ":id_utilisateur" => $_SESSION['user']['id_utilisateur']));
  } catch (PDOException $e) {
      die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }




 
  $sql = 'SELECT * FROM note WHERE id_utilisateur = :id_utilsateur and id_periode = :periode order by id_note desc';
  try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array( ":id_periode" => $periode,
      ":id_utilisateur" => $_SESSION['user']['id_utilisateur']));
      $tableaux = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }









/*
  $sql = "SELECT * FROM periode WHERE est_active ='1' ;";
  
  try {
    $sth = $dbh->prepare($sql);
  
    $sth->execute(array());
    $tableaux = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
/*

  $sql = "INSERT INTO ligne( `dat_ligne`, `id_motif`, `lib_trajet`, `nb_km`, `mt_km`, `mt_peage`, `mt_repas`, `mt_hebergement`, `id_note`) VALUES (:dat_ligne, :id_motif, :lib_trajet, :nb_km, :mt_peage, :mt_repas, :mt_hebergement,:id_note)";
  $params = array(
    ":dat_ligne" => $dat_ligne,
    ":id_motif" => $id_motif,
    ":lib_trajet" => $lib_trajet,
    ":nb_km" => $nb_km,
    ":mt_peage" => $mt_peage,
    ":mt_repas" => $mt_repas,
    ":mt_hebergement" => $mt_hebergement,
    ":id_note" =>$rof['id_note']
  );

  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $nb = $sth->rowcount();
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
  */
 
} else {
  $message = "Veuillez saisir une note de frais";
}
// Affichage
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREDI</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h1>Ajout de la nouvelle ligne de frais</h1>
  </p><a href="notes_frais.php">Retour à la liste des notes</a></p>
  
  </p>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <?php
    echo '<label for="periode"> periode : </label>';
    echo '<select id="periode" name="periode" >';
    echo '   <option value="0"> choix</option>';
    foreach ($tableaux as $tableau) {
      echo '   <option value="' . $tableau['id_periode'] . '">' . $tableau['lib_periode'].$tableau['id_periode']  . '</option>';
    }
    echo '</select>';
    echo '<p>Date<br /><input name="dat_ligne" id="dat_ligne" type="date" value="" /></p>';

    echo '<label for="motif"> motif : </label>';
    echo '<select id="motif" name="motif" >';
    echo '   <option value="0"> choix</option>';
    foreach ($rows as $row) {
      echo '   <option value="' . $row['id_motif'] . '">' . $row['lib_motif'] . '</option>';
    }
    echo '</select>';

    ?>

    <p>Trajet<br /><input name="lib_trajet" id="lib_trajet" type="text" value="" /></p>
    <p>Nombre de km(s)<br /><input name="nb_km" id="nb_km" type="text" value="" /></p>
    <p>Montant péage<br /><input name="mt_peage" id="mt_peage" type="text" value="" /></p>
    <p>Montant repas<br /><input name="mt_repas" id="mt_repas" type="text" value="" /></p>
    <p>Montant hébergement<br /><input name="mt_hebergement" id="mt_hebergement" type="text" value="" /></p>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
  </form>
</body>

</html>