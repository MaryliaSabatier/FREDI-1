<?php
$page = "supprimer_notes.php";
include 'init.php';
include 'sql.php';
include 'header.php';

// Connexion à la base
require('sql.php');

// Récupère l'ID passé dans l'URL 
$id = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : '';

// Lecture du formulaire
$submit = isset($_POST['submit']);

// Suppression dans la base
if ($submit) {
  // Formulaire validé : on supprime l'enregistrement
  $sql = "select * from ligne where id_ligne=:id_ligne";
  $params = array(
    ":id_ligne" => $id
  );
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

  $id_note = $row['id_note'];
  $sql = "select * from note where id_note=:id_note";
  $params = array(
    ":id_note" => $id_note
  );
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }




  // Suppression de la ligne
  $sql = "delete from ligne where id_ligne=:id_ligne";
  $params = array(
    ":id_ligne" => $id
  );
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $nb = $sth->rowcount();
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
  $sql = "delete from note where id_note=:id_note";
  $params = array(
    ":id_note" => $id_note
  );
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $nb = $sth->rowcount();
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
  $dat_ligne = "";
  $id_motif = "";
  $lib_trajet = "";
  $nb_km = "";
  $mt_km = "";
  $mt_peage = "";
  $mt_repas   = "";
  $mt_hebergement = "";
  $mt_total = "";
  $message = "$nb ligne supprimé";
} else {
  // Formulaire non encore validé : on affiche l'enregistrement
  $sql = "select * from ligne where id_ligne=:id_ligne";
  $params = array(
    ":id_ligne" => $id
  );
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
  $dat_ligne = $row["dat_ligne"];
  $id_motif = $row["id_motif"];
  $lib_trajet = $row["lib_trajet"];
  $nb_km = $row["nb_km"];
  $mt_km = $row["mt_km"];
  $mt_peage = $row["mt_peage"];
  $mt_repas = $row["mt_repas"];
  $mt_hebergement = $row["mt_hebergement"];
  $mt_total = $row["mt_total"];
  $message = "Veuillez valider la suppression de la ligne SVP";
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
  <h1>Suppression</h1>
  <h2>Suppression de la ligne de frais</h2>
  <li><a href="notes_frais.php">Retour aux lignes de frais accueil</a></li>
  <p><?php echo $message; ?>
  </p>
  <form action="<?php echo $_SERVER['PHP_SELF'] . "?id_ligne=" . $id; ?>" method="post">
    <p>Date<br /><input name="dat_ligne" id="dat_ligne" type="date" value="<?= $dat_ligne ?>" disabled /></p>
    <p>Motif<br /><input name="id_motif" id="id_motif" type="text" value="<?= $id_motif ?>" disabled /></p>
    <p>Trajet<br /><input name="lib_trajet" id="lib_trajet" type="text" value="<?= $lib_trajet ?>" disabled /></p>
    <p>Kms parcourus<br /><input name="nb_km" id="nb_km" type="text" value="<?= $nb_km ?>" disabled /></p>
    <p>Total frais Kms<br /><input name="mt_km" id="mt_km" type="text" value="<?= $mt_km ?>" disabled /></p>
    <p>Cout péage<br /><input name="mt_peage" id="mt_peage" type="text" value="<?= $mt_peage ?>" disabled /></p>
    <p>Cout repas<br /><input name="mt_repas" id="mt_repas" type="text" value="<?= $mt_repas ?>" disabled /></p>
    <p>Cout hebergement<br /><input name="mt_hebergement" id="mt_hebergement" type="text" value="<?= $mt_hebergement ?>" disabled /></p>
    <p>Total<br /><input name="mt_total" id="mt_total" type="text" value="<?= $mt_total ?>" disabled /></p>
    <div><input name="id" id="id" type="hidden" value="<?php echo $id; ?>" /></div>
    <p><input type="submit" name="submit" value="Supprimer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
  </form>
</body>

</html>


<?php
require('footer.php');
?>