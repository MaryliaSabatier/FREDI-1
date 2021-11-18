<?php
include 'sql.php';

$sql = "select * from periode where est_active='1'";
try {
  $sth = $dbh->prepare($sql);

  $sth->execute();
  $periode = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}


?>