<?php
$page="notes_frais.php";
include 'init.php';
include 'sql.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Note de frais</title>
</head>
<body>
<h1>Affichage de la note de frais</h1>
    <img src="img/logo.png">
    <?php
    echo'<h1> Je sousigné()e'.$session['user']['nom'].$session['prenom']</h1>';
    
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
          echo '<td><a href="modif_utilisateur.php?id_utilisateur=' . $row['id_utilisateur'] . '">Modifier</a>&nbsp;';
          echo "</tr>";
        }?>
      </table>
</body>
</html>
<?php
require('footer.php');
?>