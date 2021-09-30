<?php
/**
 * ph143 - Europa
 * Chargement du fichier CSV dans la base MySQL
 */
// Initialisations
include 'sql.php';

// Connexion à la base
$dbh = db_connect();
// Import du fichier CSV sous la forme d'un tablau PHP
$rows = load_from_csv(ROOT . DS . "files" . DS . "pays.csv", 2);
// Génération des ordres SQL de réinitialisation de la base (drop/create)
$sql = file_get_contents(ROOT . DS . "sql" . DS . "europa.sql") . PHP_EOL;
// Génération de l'ordre SQL "INSERT"
$sql .= "USE europa;" . PHP_EOL;
$sql .= "INSERT INTO pays(nom_fr, date_adhesion, code, nom_local, capitale, langues, monnaie)  VALUES " . PHP_EOL;
foreach ($rows as $row) {
$sql .= "(";
$sql .= $dbh->quote( $row[0], PDO::PARAM_STR). ", "; // Nom dans le romand'Alexandre Dumas
$sql .= "'". convertir_date($row[1])."',"; // Vrai nom qui a inspiré le personnage
$sql .="'". $row[2]."'," ;
$sql .="'". $row[3]."'," ;
$sql .="'". $row[4]."'," ;
$sql .="'". $row[5]."'," ;
$sql .="'". $row[6]."'" ;

$sql .= ")," . PHP_EOL;
}
// Enlève la dernière virgule qui est en trop
$sql = rtrim($sql, PHP_EOL);
$sql = rtrim($sql, ',');
// Exécution des ordres SQL 
try {
$sth = $dbh->prepare($sql);
$sth->execute();
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

// Affichage
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ph143 - Europa</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h1>ph143 - Europa</h1>
  <h2>Chargement des pays</h2>
  <?php
  include "menu.php";
  ?>
</body>

</html>