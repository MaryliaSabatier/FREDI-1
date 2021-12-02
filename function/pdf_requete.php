<?php
include 'sql.php';
session_start();

// Requete pour afficher la période
$sql = "select * from periode where est_active='1'";
try {
  $sth = $dbh->prepare($sql);

  $sth->execute();
  $periode = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

// Requete pour afficher le nom et prénom du user
$sql = "select * from utilisateur where id_utilisateur = :id_utilisateur";
try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array(
  ":id_utilisateur" => $_SESSION["user"]["id_utilisateur"]
));
  $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

// Requete pour afficher l'adresse du user'
$sql = 'select * from adherent ,utilisateur where adherent.id_utilisateur=utilisateur.id_utilisateur and utilisateur.id_utilisateur=:id_utilisateur;';

try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array( 
    ":id_utilisateur" => $_SESSION["user"]["id_utilisateur"]
));
  $adherent = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

// Requete pour afficher le tableau
$sql = 'select * from ligne, note where ligne.id_note=note.id_note and id_utilisateur=:id_utilisateur';

try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array( 
    ":id_utilisateur" => $_SESSION["user"]["id_utilisateur"]
));
  $lignes = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}


?>