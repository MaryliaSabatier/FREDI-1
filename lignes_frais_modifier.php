<?php
// Initialisations
$page = "lignes_frais_notes.php";
include 'init.php';
include 'sql.php';
include 'header.php';


$id_ligne = isset($_POST['id_ligne']) ? $_POST['id_ligne'] : '';
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




?>

<br>
<br>
<?php


$submit = isset($_POST['submit']);

// Ajout dans la base
if ($submit) {
  $id_ligne = $id_ligne;
  $dat_ligne = isset($_POST['dat_ligne']) ? $_POST['dat_ligne'] : '';
  $id_motif = isset($_POST['motif']) ? $_POST['motif'] : '';
  echo '<br><br>';
  echo $periode = isset($_POST['periode']) ? $_POST['periode'] : '';
  $lib_trajet = isset($_POST['lib_trajet']) ? $_POST['lib_trajet'] : '';

  $nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
  $mt_km = isset($_POST['mt_km']) ? $_POST['mt_km'] : '';
  $mt_peage = isset($_POST['mt_peage']) ? $_POST['mt_peage'] : '';
  $mt_repas = isset($_POST['mt_repas']) ? $_POST['mt_repas'] : '';
  $mt_hebergement = isset($_POST['mt_hebergement']) ? $_POST['mt_hebergement'] : '';
  $id_utilisateur = $_SESSION['user']['id_utilisateur'];
  $num = random_int(0, 99999999999);




  $sql = "update note set id_periode =:id_periode , dat_remise=:dat_remise,nr_ordre=:nr_ordre where  id_utilisateur= :id_utilisateur";
  try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
      ":id_periode" => $periode,
      ":id_utilisateur" => $_SESSION['user']['id_utilisateur'], ':dat_remise' => $dat_ligne, ':nr_ordre' => $num
    ));
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

  $sql = 'select * from note where id_utilisateur =:id_utilisateur and id_periode = :periode;';

  try {
    $sth = $dbh->prepare($sql);

    $sth->execute(array(":id_utilisateur" => $id_utilisateur, ":periode" => $periode));
    $roows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

  foreach ($roows as $row) {

    $id_note = $row['id_note'];
  }
  echo $id_ligne;


  try {
    $sth = $dbh->prepare("update  ligne set  id_motif =:id_motif ,mt_hebergement =:mt_hebergement ,dat_ligne =:dat_ligne ,lib_trajet =:lib_trajet , nb_km =:nb_km ,mt_km =:mt_km ,mt_peage = :mt_peage,mt_repas=:mt_repas  where id_ligne =:id_ligne;");
    $sth->execute(array(
      ":lib_trajet" => $lib_trajet,
      ":nb_km" => $nb_km,
      ":mt_km" => $mt_km,
      ":mt_repas" => $mt_repas,
      ":mt_peage" => $mt_peage,
      ":id_motif" => $id_motif,
      ":dat_ligne" => $dat_ligne,
      ":mt_hebergement" => $mt_hebergement,
     
      ":id_ligne" => $id_ligne
    ));
    $nb = $sth->rowcount();
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }
  header("Location: notes_frais.php");
} else {

  $id_ligne = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : '';

  try {
    $sth = $dbh->prepare('select * from ligne where id_ligne=:id_ligne;');

    $sth->execute(array(":id_ligne" => $id_ligne));
    $roows1 = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }


  $dat_ligne = $roows1["dat_ligne"];
  $lib_trajet = $roows1["lib_trajet"];
  $nb_km = $roows1["nb_km"];
  $mt_km = $roows1["mt_km"];
  $mt_peage = $roows1["mt_peage"];
  $mt_repas = $roows1["mt_repas"];
  $mt_hebergement = $roows1["mt_hebergement"];
  echo  "Veuillez saisir une note de frais";
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
   
    foreach ($tableaux as $tableau) {
      echo '   <option value="' . $tableau['id_periode'] . '">' . $tableau['lib_periode'] . $tableau['id_periode']  . '</option>';
    }
    echo '</select>';
    echo '<p>Date<br /><input name="dat_ligne" id="dat_ligne" type="date" value="" /></p>';

    echo '<label for="motif"> motif : </label>';
    echo '<select id="motif" name="motif" >';
   
    foreach ($rows as $row) {
      echo '   <option value="'.$row['id_motif'].'"> '. $row['lib_motif'] .'</option>';
     
    }
    echo '</select>';



    echo "                      <p>Trajet<br /><input name='lib_trajet' id='lib_trajet' type='text' value='" . $roows1['lib_trajet'] . "' /></p>";
    echo "                       <p>Nombre de km(s)<br /><input name='nb_km' id='nb_km' type='text' value='" . $roows1['nb_km'] . "' /></p>";
    echo "                      <p>Montant du km(s)<br /><input name='mt_km' id='mt_km' type='text' value='" . $roows1['mt_km'] . "' /></p>";
    echo "                   <p>Montant péage<br /><input name='mt_peage' id='mt_peage' type='text' value='" . $roows1['mt_peage'] . "' /></p>";
    echo "                   <p>Montant repas<br /><input name='mt_repas' id='mt_repas' type='text' value='" . $roows1['mt_repas'] . "' /></p>";
    echo "   <p>Montant hébergement<br /><input name='mt_hebergement' id='mt_hebergement' type='text' value='" . $roows1['mt_hebergement'] . "'/></p>";
    echo "                                                                    <input  type='hidden' name='id_ligne' id='id_ligne' value='" . $id_ligne  . "'> ";
    echo "      <p><input type='submit' name='submit' value='Envoyer' />&nbsp;<input type='reset' value='Réinitialiser' /></p>";


    ?>

  </form>
</body>

</html>