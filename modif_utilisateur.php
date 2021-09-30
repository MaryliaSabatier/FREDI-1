<?php
$page="modif_utilisateur.php";
include 'init.php';
include 'sql.php';

// Récupère l'ID passé dans l'URL 
$id_utilisateur = isset($_GET['id_utilisateur']) ? $_GET['id_utilisateur'] : '';

// Lecture du formulaire
$role = isset($_POST['langues']) ? $_POST['langues'] : '';

$submit = isset($_POST['submit']);

// Modification dans la base
if ($submit) {
    // Formulaire validé : on modifie l'enregistrement
    $id_utilisateur = $_POST['id_utilisateur'];
    $sql = "update utilisateur set role=:role";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":role" => $role));
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $message = "$nb utilisateur modifié(s)";
} else {
    // Formulaire non encore validé : on affiche l'enregistrement
    $sql = "select * from utilisateur where id_utilisateur=:id_utilisateur";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":id_utilisateur" => $id_utilisateur));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    $role = $row['role'];

    $message = "Veuillez réaliser la modification du role de l'ID $id_utilisateur SVP";
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
  <h2>Modification de l'utilisateur</h2>
  <p><?php echo $message; ?>
  </p>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p>Rôle<br /><input name="role" id="role" type="text" value="" /></p>
    <div><input name="id_utilisateur" id="id_utilisateur" type="hidden" value="<?php echo $id_utilisateur; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
  </form>
</body>

</html>