<?php
$page="notes_frais.php";
include 'init.php';
include 'sql.php';
include 'header.php';

// Récupère la liste des lignes
$sql = 'select * from note , ligne ,utilisateur where note.id_utilisateur=utilisateur.id_utilisateur and ligne.id_note =note.id_note and utilisateur.id_utilisateur=:id;';

try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array(":id"=>$session['user']['id_utilisateur']));
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}
?>


<!DOCTYPE html>
<html lang="fr">
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
     echo'<p>Je sousigné()e'.$session['user']['nom'].$session['prenom'].'</p>';
     echo'<p>Demeurant'.$session['user']['adr1'].$session['adr2'].$session['adr3'].'</p>';
     echo'<p>Certifie renoncer au remboursement des frais ci dessous et les laisser à l association (mettre le nom + adresse) en tant que don </p>';
    ?>

    <h3>Frais de déplacement</h3>

        <table class="container">
        <tr>
          <th>Date</th>
          <th>Motif</th>
          <th>Trajet</th>
          <th>Kms parcourus</th>
          <th>Total frais kms</th>
          <th>Cout péages</th>
          <th>Cout repas</th>
          <th>Cout hébergement</th>
          <th>Total</th>
          <th>&nbsp;</th>
        </tr>

        <?php
        foreach ($rows as $row) {
          echo '<tr>';
          echo '<td>'. $row['dat_ligne'] .'</td>';
          echo '<td>' . $row['id_motif'] . '</td>';
          echo '<td>' . $row['lib_trajet'] . '</td>';
          echo '<td>' . $row['nb_km'] . '</td>';
          echo '<td>' . $row['mt_km'] . '</td>';
          echo '<td>' . $row['mt_peage'] . '</td>';
          echo '<td>' . $row['mt_repas'] . '</td>';
          echo '<td>' . $row['mt_hebergement'] . '</td>';
          echo '<td>' . $row['mt_total'] . '</td>';
          echo '<td><a href="modif_notes.php?id_ligne=' . $row['id_ligne'] . '">Modifier</a>&nbsp;';
          echo '<td><a href="supprimer_notes.php?id_ligne=' . $row['id_ligne'] . '">Supprimer</a>;';
          echo "</tr>";
        }?>
      </table>

      <p>Il y a <?php echo count($rows); ?> ligne(s) de frais</p>
      <p><a href="lignes_frais_ajouter.php">Ajouter</a> une ligne nouvelle ligne de frais</p>
      <p><a href="notes_frais.pdf.php">Télécharger</a> le PDF</p>
<?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Création d'un texte 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Bonjour le monde');  // 40=largeur en mm; 10 = hauteur

// Génération du document PDF dans le dossier outfiles
$pdf->Output('outfiles/notes_frais.pdf','f');  // f=fichier local
header('Location: notes_frais.php');
?>

    </body>
</html>
<?php
require('footer.php');
?>