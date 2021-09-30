<?php
/**
 * ph143b - Europa
 * Liste des pays
 */
// Initialisations
include 'init.php';

// Connexion à la base
$dbh = db_connect();

// Récupère la liste des pays
$sql = 'select * from pays';
try {
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}
// Affichage
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ph143b - Europa</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h1>ph143b - Europa</h1>
  <h2>Liste des pays de l'Union Européenne</h2>
  <?php
  include "menu.php";
  if (count($rows) > 0) {
  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Date d'adhésion</th>
        <th>Code</th>
        <th>Nom local</th>
        <th>Capitale</th>
        <th>Langue(s) officielle(s)</th>
        <th>Monnaie</th>
        <th>&nbsp;</th>
      </tr>
      <?php
      foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['id_pays'] . '</td>';
        echo '<td>' . $row['nom_fr'] . '</td>';
        echo '<td>' . $row['date_adhesion'] . '</td>';
        echo '<td>' . $row['code'] . '</td>';
        echo '<td>' . $row['nom_local'] . '</td>';
        echo '<td>' . $row['capitale'] . '</td>';
        echo '<td>' . $row['langues'] . '</td>';
        echo '<td>' . $row['monnaie'] . '</td>';
        echo '<td><a href="pays_modifier.php?id_pays=' . $row['id_pays'] . '">Modifier</a>&nbsp;';
        echo '<a href="pays_supprimer.php?id_pays=' . $row['id_pays'] . '">Supprimer</a></td>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <p><?php echo count($rows); ?> pays(s)</p>
  <p><a href="pays_ajouter.php">Ajouter</a> un pays</p>
</body>

</html>