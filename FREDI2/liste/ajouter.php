<?php $active=2; $title = "Ajouter"; require('../header.php'); ?>
<h1>Ajouter une question à la FAQ</h1>
<form id="Ajout" action="ajouter_validation.php" method="post">
  <table>
    <tr><td><h3>Ecrivez votre question :</h3></td></tr>
    <tr><td><textarea name="question" id="question" rows="10" cols="50"></textarea></td></tr>
    <tr><td><input class="button green full" type="submit" value="Soumettre"/></td><td><input class="button red" type="reset" value="Vider" /></td></tr>
  </table>  
</form>
<br>
<a href="liste.php"><input class="button blue" type="submit" value="Annuler"/></a>
<?php require('../footer.php'); ?> 