<?php
include 'init.php';
include 'sql.php';

// Récupère la liste des pays
$sql = 'select * from utilisateur';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freddi</title>
</head>
<body>
    <h1>Affichage des utlisateurs</h1>
  <?php
  if (count($rows) > 0) {
  ?>
    <table>
      <tr>
        <th>Id utilisateur</th>
        <th>Pseudo</th>
        <th>Mot de passe</th>
        <th>Mail</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Rôle</th>
        <th>&nbsp;</th>
      </tr>
      <?php
      foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['id_utilisateur'] . '</td>';
        echo '<td>' . $row['pseudo'] . '</td>';
        echo '<td>' . $row['mdp'] . '</td>';
        echo '<td>' . $row['mail'] . '</td>';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['prenom'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <p><?php echo count($rows); ?> pays(s)</p>

</body>
</html>