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

// Requete pour afficher l'adresse du user
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

// Requete pour afficher l'adresse des clubs
$sql = 'select lib_club, club.adr1 as adr1, club.adr2 as adr2, club.adr3 as adr3 from club ,adherent where adherent.id_club=club.id_club and id_utilisateur=:id_utilisateur';
echo($sql);
try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array( 
    ":id_utilisateur" => $_SESSION["user"]["id_utilisateur"]
));
  $club = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

// Requete license
$sql = "select * from adherent where id_utilisateur = :id_utilisateur";
try {
  $sth = $dbh->prepare($sql);

  $sth->execute(array(
  ":id_utilisateur" => $_SESSION["user"]["id_utilisateur"]
));
  $utilisateurs = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

$sql = "SELECT ligue.id_ligue, ligue.lib_ligue, club.id_club, club.lib_club FROM club, ligue, motif WHERE ligue.id_ligue = club.id_ligue GROUP by id_club";
try {
  $sth = $dbh->prepare($sql);
  $sth->execute(array());
  $club1 = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}




?>