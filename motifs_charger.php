<?php
// Initialisations
include 'sql.php';
include 'init.php';
// Connexion à la base
// Import du fichier CSV sous la forme d'un tablau PHP
$rows = load_from_csv(ROOT . DS . "files" . DS . "motifs.csv", 2);
// Génération des ordres SQL de réinitialisation de la base (drop/create)
$sql = file_get_contents(ROOT . DS . "BDD" . DS . "fredi21.sql") . PHP_EOL;
// Génération de l'ordre SQL "INSERT"
$sql .= "USE fredi21;" . PHP_EOL;
$sql .= "INSERT INTO motif(id_motif, lib_motif)  VALUES " . PHP_EOL;
foreach ($rows as $row) {
$sql .= "(";
$sql .= $dbh->quote( $row[0], PDO::PARAM_STR). ", "; // id motif
$sql .="'". $row[1]."'"; // lob motif

$sql .= ")," . PHP_EOL;

}
// Enlève la dernière virgule qui est en trop
$sql = rtrim($sql, PHP_EOL);
$sql = rtrim($sql, ',');
// Exécution des ordres SQL
echo($sql); 
try {
$sth = $dbh->prepare($sql);
$sth->execute();
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
?>