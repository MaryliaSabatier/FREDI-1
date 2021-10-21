<?php
// Initialisations
include 'sql.php';
include 'init.php';
// Connexion à la base
// Import du fichier CSV sous la forme d'un tablau PHP
$rows = load_from_csv(ROOT . DS . "files" . DS . "ligues.csv", 2);
// Génération des ordres SQL de réinitialisation de la base (drop/create)
$sql = file_get_contents(ROOT . DS . "BDD" . DS . "ligue.sql") . PHP_EOL;
// Génération de l'ordre SQL "INSERT"
$sql .= "USE fredi21;" . PHP_EOL;
$sql .="SET FOREIGN_KEY_CHECKS = 0; ";
$sql .= "INSERT INTO ligue (id_ligue, lib_ligue)  VALUES " . PHP_EOL;
foreach ($rows as $row) {
$sql .= "(";
$sql .= $dbh->quote( $row[0], PDO::PARAM_STR). ", ";
$sql .="'". $row[1]."'"; 

$sql .= ")," . PHP_EOL;

}
// Enlève la dernière virgule qui est en trop
$sql = rtrim($sql, PHP_EOL);
$sql = rtrim($sql, ',');
$sql .=" ;SET FOREIGN_KEY_CHECKS = 1;";
// Exécution des ordres SQL
echo($sql); 
try {
$sth = $dbh->prepare($sql);
$sth->execute();
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
?>
