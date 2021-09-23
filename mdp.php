<?php
 $active=1; $title = "Accueil"; require('header.php'); require('sql.php');
 $id_utilisateur = isset($_GET['id_utilisateurr']) ? $_GET['id_utilisateur'] : null;

?>

    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mot de passe</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <ul>
           
        
    </ul>
  

<div class="marg">
<p><h2>Votre nouveau mot de passe est M2L</h2></p>
<br><br>

<?php


echo $id_utilisateur;
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 
  
   
    <input type="submit" name="submit" value="Valider">
    <input type="text" name="id" hidden value="<?= $id_utilisateur ?>"><! -- renvois de l'id "caché"  -->
</form>


<br>
</div>
<?php  $active=1; $title = "mot de passe oublié"; require('footer.php'); ?>
</body>
 
</html>