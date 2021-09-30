<?php
include "init.php";
require('sql.php');


// Import du fichier CSV sous la forme d'un tablau PHP
$rows = load_from_csv(ROOT . DS . "files" . DS . "clubs.csv", 2);

// Génération des ordres SQL de réinitialisation de la base (drop/create)
$sql = file_get_contents(ROOT . DS . "sql" . DS . "fredi21.sql") . PHP_EOL;
// Génération de l'ordre SQL "INSERT"
$sql .= "USE fredi21;" . PHP_EOL;
$sql .= "INSERT INTO club(id_club, lib_club, adr1, adr2, adr3, id_ligue) VALUES " . PHP_EOL;
foreach ($rows as $row) {
  $sql .= "(";
  $sql .= $dbh->quote( $row[0], PDO::PARAM_STR). ","; // id club
  $sql .= $dbh->quote( $row[1]), PDO::PARAM_STR). ", "; // lib club
  $sql .= $dbh->quote( $row[2], PDO::PARAM_STR). ", ";  // adresse 1
  $sql .= $dbh->quote( $row[3], PDO::PARAM_STR). ", ";  // adresse 2
  $sql .= $dbh->quote( $row[4], PDO::PARAM_STR). ", ";  // adresse 3
  $sql .= $dbh->quote( $row[5], PDO::PARAM_STR); // id ligue
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
    header('Location: clubs_liste.php');  //revois vers la liste des clubs   
?>

