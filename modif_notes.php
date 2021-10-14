<?php
$page="modif_notes.php";
include 'init.php';
include 'sql.php';

// Récupère l'ID passé dans l'URL 
$id_ligne = isset($_GET['id_ligne']) ? $_GET['id_ligne'] : '';

// Lecture du formulaire
$dat_ligne = isset($_POST['dat_ligne']) ? $_POST['dat_ligne'] : '';
$dat_ligne = isset($_POST['id_motif']) ? $_POST['id_motif'] : '';
$lib_trajet = isset($_POST['lib_trajet']) ? $_POST['lib_trajet'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$mt_km = isset($_POST['mt_km']) ? $_POST['mt_km'] : '';
$mt_peage = isset($_POST['mt_peage']) ? $_POST['mt_peage'] : '';
$mt_repas = isset($_POST['mt_repas']) ? $_POST['mt_repas'] : '';
$mt_hebergement = isset($_POST['mt_hebergement']) ? $_POST['mt_hebergement'] : '';

$submit = isset($_POST['submit']);

// Modification dans la base
if ($submit) {
    // Formulaire validé : on modifie l'enregistrement
    $id_ligne = $_POST['id_ligne'];
    $sql = "update ligne set dat_ligne=:dat_ligne,id_motif=:id_motif,lib_trajet=:lib_trajet,nb_km=:nb_km,mt_km=:mt_km,mt_peage=:mt_peage,mt_repas=:mt_repas,mt_hebergement=:mt_hebergement where id_ligne=:id_ligne";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":dat_ligne" => $dat_ligne,":id_motif" => $id_motif,":lib_trajet" => $lib_trajet,":nb_km" => $nb_km,":mt_km" => $mt_km,":mt_peage" => $mt_peage,":mt_repas" => $mt_repas,":mt_hebergement" => $mt_hebergement, ":id_ligne" => $id_ligne));
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $message = "$nb notes modifié(s)";
} else {
    // Formulaire non encore validé : on affiche l'enregistrement
    $sql = "select * from ligne where id_ligne=:id_ligne";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":id_ligne" => $id_ligne));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    $id_ligne = $row['id_ligne'];

    $message = "Veuillez réaliser la modification de la note $id_ligne SVP";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Freddi</title>
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <h1>Freddi</h1>
  <h2>Modification de la note</h2>
  <p><?php echo $message; ?>
  </p>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p>Date<br /><input name="dat_ligne" id="dat_ligne" type="date" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Motif<br /><input name="lib_trajet" id="lib_trajet" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Trajet<br /><input name="dat_ligne" id="dat_ligne" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Kilomètre parcourus<br /><input name="nb_km" id="nb_km" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Total frais kilometres<br /><input name="mt_km" id="mt_km" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Coût péages<br /><input name="mt_peage" id="mt_peage" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Coût repas<br /><input name="mt_repas" id="mt_repas" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p>Côut hébergement<br /><input name="mt_hebergement" id="mt_hebergement" type="text" value="" /></p>
    <div><input name="id_ligne" id="id_ligne" type="hidden" value="<?php echo $id_ligne; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
  </form>
</body>

</html>
