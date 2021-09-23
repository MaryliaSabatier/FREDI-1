<?php
  $active=2; $title = "Ajouter"; require('../header.php'); require('../sql.php');
  //La question saisi par l'user va dans la variable $question (isset = si elle existe)
  $question=isset($_POST['question']) ? $_POST['question'] :  "";
  // Requête sql pour insérer la question, l'id du user et la date  
  $sql ="insert into faq (question,id_user, dat_question)";
  $sql.="values (:question,:id_user, CURRENT_TIMESTAMP)";
  // Lecture de la question et id user dans la base de donnée
  try {
    $sth = $dbh->prepare($sql); // Prépare la rêquete sql
    $sth->execute(array( // Exécute la rêquete
      ':question' => $question, // La question va se stocker dans $question
      ':id_user' => $_SESSION['user']['id_user'] // L'id du user va se stocker dans sa session $SESSION 
    ));
  } // Gestion des erreurs
  catch (PDOException $ex){
    die("Erreur lors de la rêquete SQL : ".$ex->getMessage());
  }
  // Met un message dans la session message 
  $_SESSION['messages']=array(
    "FAQ" => ["green", "Un nouveau message a été ajouté"]
  );
  //Redirige vers l'accueil
  header("Location: liste.php");
?>