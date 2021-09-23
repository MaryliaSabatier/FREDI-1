<?php
  //Permet la connexion à la BDD avec les paramètres
  $dsn='mysql:host=127.0.0.1;dbname=m2l';
  $username="maison2ligue";
  $password="Maisondeuxligues";
  //Crée une connexion PDO
  try {
      $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dbh;
  //Gestion des erreurs
  } catch (PDOExeption $ex) {
    die("Erreur lors de  la requetes SQL : ".$ex->getMessage());
  }
?>