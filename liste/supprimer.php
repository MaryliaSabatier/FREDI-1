<?php $active=2; $title = "Supprimer"; require('../header.php'); require('../sql.php') ?>
<?php
//Récupère l'id de la question
if(isset($_GET['id'])){
    $id = isset($_GET['id'])?$_GET['id']:null;
    //Prend la question et la réponse associées à l'id
    $sql = "SELECT question, reponse FROM faq WHERE id_faq=:id";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
    ':id' => $id
    ));
    $question=$sth->fetch(PDO::FETCH_ASSOC);
    //Gestion des erreurs
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : ".$ex->getMessage());
    }
}
?>
  
  <h1>Supprimer une question</h1>
  <form id="supprimer" action="supprimer_validation.php" method="post">
  <table>
    <tr><td><h3>Question</h3></td></tr>
    <tr><td><textarea name="question" id="question" rows="10" cols="50" disabled="disabled"><?= $question['question'];?></textarea></td></tr>
    <tr><td><h3>Réponse</h3></td></tr>
    <tr><td><textarea name="reponse" id="reponse" rows="10" cols="50" disabled="disabled" ><?= $question['reponse'];?></textarea></td></tr>
    <tr><td><input class="button red full" type="submit" name="submit" value="Supprimer"/></td></tr>
  </table>
  <input type="text" name="id" value="<?=$id?>" hidden/>
  </form>
  <br>
  <a href="liste.php"><input class="button blue" type="submit" value="Retour"></a>
<?php require('../footer.php'); ?>