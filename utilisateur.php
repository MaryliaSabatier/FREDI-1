<?php
include 'init.php';
include 'sql.php';


 $active=4; $title = "Connexion"; require('header.php'); require('sql.php') ;$page=$_SERVER['PHP_SELF'];
    //Le pseudo saisi par l'user va dans la variable $pseudo
   
    //Le mdp saisi par l'user va dans la variable $password
   
  //  logToDisk($page,$pseudo,$password);




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
    <link rel="stylesheet" href="css/main.css">
    <title>Freddi</title>
</head>
<body>
    <h1>Affichage des utilisateurs</h1>
  <?php
  if (count($rows) > 0) {
  ?>
      <table class="container">
      <tr>
        <th>Id utilisateur</th>
        <th>Pseudo</th>
        <th>Mot de passe</th>
        <th>Mail</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Rôle</th>
        <th>modifier</th>
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
        echo '<td><a href="modif_utilisateur.php?id_utilisateur=' . $row['id_utilisateur'] . '">Modifier</a>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <p><?php echo count($rows); ?> utilisateur(s)</p>

</body>
</html>
