<?php
// Initialisations
include 'sql.php';
include 'init.php';
// Connexion à la base
// Import du fichier CSV sous la forme d'un tablau PHP
$rows = load_from_csv(ROOT . DS . "files" . DS . "club.csv", 1);
// Génération des ordres SQL de réinitialisation de la base (drop/create)
$sql = file_get_contents(ROOT . DS . "BDD" . DS . "club.sql") . PHP_EOL;
// Génération de l'ordre SQL "INSERT"
$sql .= "USE `fredi21`;" . PHP_EOL;
$sql .="SET FOREIGN_KEY_CHECKS = 0; ";
$sql .= "INSERT INTO `club`(id_club	,lib_club	,adr1	,adr2	,adr3	,id_ligue	) VALUES " . PHP_EOL;
foreach ($rows as $row) {
  $sql .= "(";
  $sql .= $dbh->quote( $row[0], PDO::PARAM_STR). ", "; 
  $sql .= $dbh->quote( $row[1], PDO::PARAM_STR). ", "; 
  $sql .= $dbh->quote( $row[2], PDO::PARAM_STR). ", ";  
  $sql .= $dbh->quote( $row[3], PDO::PARAM_STR). ", "; 
  $sql .= $dbh->quote( $row[4], PDO::PARAM_STR). ", ";  
  $sql .= $dbh->quote( $row[5], PDO::PARAM_STR); 
  $sql .= ")," . PHP_EOL;
}
// Enlève la dernière virgule qui est en trop
$sql = rtrim($sql, PHP_EOL);
$sql = rtrim($sql, ',');
$sql .=" ;SET FOREIGN_KEY_CHECKS = 1;";
// Exécution des ordres SQL
print_r($sql);
try {
  $sth = $dbh->prepare($sql);
  $sth->execute();
} catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
// Exécution des ordres SQL

try {
$sth = $dbh->prepare($sql);
$sth->execute();
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>


